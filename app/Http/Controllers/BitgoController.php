<?php

namespace App\Http\Controllers;

use App\Events\DepositReceived;
use App\Events\WithdrawalRequest;
use App\Helpers\GeneralHelper;

use App\Models\Deposit;
use App\Models\OfflineWallet;
use App\Models\PaymentGateway;
use App\Models\TradeCurrency;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserBankAccount;
use App\Models\WalletAddress;
use App\Models\Withdrawal;
use App\Models\WithdrawalMethod;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Stripe\Stripe;
use Omnipay\Omnipay;

use neto737\BitGoSDK\BitGoSDK;
use neto737\BitGoSDK\BitGoExpress;
use neto737\BitGoSDK\Enum\CurrencyCode;

class BitgoController extends Controller {
    
  

      public function webhookCallback(Request $request) {
      
                //Storage::disk('local')->put($request->hash.'.txt', json_encode($request->all()));
                $setting = Setting::where('setting_key','access_token')->first();
                $token = $setting->setting_value;
                $coin = $request->coin;
                $transactionId = $request->hash;
                $walletId = $request->wallet;
                

               if($coin == 'tbtc'){ 
                   $tradeCoin= 'bitcoin';
               } else if($coin == 'teth') {
                   $tradeCoin= 'ethereum';
               } else if($coin == 'tltc') {
                   $tradeCoin= 'litecoin';
               } else if($coin == 'txrp') {
                   $tradeCoin= 'ripple';
               }
              
    
                
                if($transactionId) {
                    
                    $bitgo = new BitGoSDK($token, $coin, true);
                    $bitgo->walletId = $walletId;
                    $webhook = $bitgo->getWalletTransaction($transactionId); 
                    //Storage::disk('local')->put('data-'.$request->hash.'.txt', json_encode($webhook));
                    $tradeCurrency = TradeCurrency::where('network', $tradeCoin)->first();
                    $deposit = Deposit::where('transaction_id',$request->hash)->first();
                    $confirmations = $webhook['confirmations'];
                

                    
                    
                       if (array_key_exists('outputs', $webhook ) ) {
                               
                               $arrayOutputs = $webhook['outputs'];
                               
                            if (array_key_exists('fromWallet', $webhook ) ) {
                    
                                  foreach ($arrayOutputs as $key) {
                                        if (array_key_exists('wallet', $key ) ) {
                                            if($key['wallet'] != $webhook['fromWallet']) {
                                                $newWallet = $key['wallet'];
                                                $satoshiAmount = $key['value'];
                                                $address = $key['address'];
                                               }
                                        }
                                      }
                               // Storage::disk('local')->put('output-fromWallet'.$newWallet.'.txt', json_encode($webhook));      
                                $walletAddress = WalletAddress::where('wallet_id', $newWallet)->where('coin',$coin)->first();
                          
                            } else {

                                  foreach ($arrayOutputs as $key) {
                                        if (array_key_exists('wallet', $key ) ) {
                                            if($key['wallet'] == $walletId) {
                                                $satoshiAmount = $key['value'];
                                                $address = $key['address'];
                                               }
                                        }
                                      }
                                 //Storage::disk('local')->put('output-toWallet'.$walletId.'.txt', json_encode($webhook));  
                                 $walletAddress = WalletAddress::where('wallet_id', $walletId)->where('coin',$coin)->first();
                            }
                                    
                       } else {
                            
                            $arrayEntries = $webhook['entries'];
                            
                            if (array_key_exists('fromWallet', $webhook ) ) {
                    
                                  foreach ($arrayEntries as $key) {
                                        if (array_key_exists('wallet', $key ) ) {
                                            if($key['wallet'] != $webhook['fromWallet']) {
                                                $newWallet = $key['wallet'];
                                                $satoshiAmount = $key['value'];
                                                $address = $key['address'];
                                               }
                                        }
                                      }
                              //Storage::disk('local')->put('entries-fromWallet'.$newWallet.'.txt', json_encode($webhook));       
                              $walletAddress = WalletAddress::where('wallet_id', $newWallet)->where('coin',$coin)->first();
                           
                            } else {

                                 foreach ($arrayEntries as $key) {
                                          if (array_key_exists('wallet', $key ) ) {
                                              if($key['wallet'] == $walletId) {
                                                  $satoshiAmount = $key['value'];
                                                  $address = $key['address'];
                                                 }
                                          }
                                        }
                              //Storage::disk('local')->put('entries-toWallet'.$walletId.'.txt', json_encode($webhook));   
                              $walletAddress = WalletAddress::where('wallet_id', $walletId)->where('coin',$coin)->first();
                           
                            }
                           
                      }
                    
              

                       if($coin == 'teth') {
                           $amount = $satoshiAmount / 1e18;         
                       } else if($coin == 'txrp') {        
                           $amount = $satoshiAmount / 1e6;         
                       } else {
                           $amount = $satoshiAmount / 1e8;
                       }


                //Storage::disk('local')->put('coin'.$amount.'.txt', json_encode($webhook));

                if(empty($deposit) && $walletAddress){
                    
                    $deposit = new Deposit();
                    $deposit->account_number = $walletId;
                    $deposit->user_id = $walletAddress->user_id;
                    $deposit->transaction_id = $transactionId;
                    $deposit->trade_currency_id = $tradeCurrency->id;
                    $deposit->confirmations = $confirmations;
                    $deposit->amount = $amount;
                    $deposit->receiver_address = $address;
                    $deposit->status = "done";
                    $deposit->notes = "Paid via bitgo";
                    $deposit->save();
                    
             
                    
                    $user = User::where('id', $walletAddress->user_id)->first();
                    
                     if($coin == 'tbtc'){ 
                           $bal = $user->bitcoin_balance;
                           $coinbal = 'bitcoin_balance';
                       } else if($coin == 'teth') {
                           $bal = $user->ethereum_balance;
                           $coinbal = 'ethereum_balance';
                       } else if($coin == 'tltc') {
                           $bal = $user->litecoin_balance;
                           $coinbal = 'litecoin_balance';
                       } else if($coin == 'txrp') {
                           $bal = $user->ripple_balance;
                           $coinbal = 'ripple_balance';
                       }
                       
                     $totalbal = $bal + $amount;
                     
                     User::where('id', $walletAddress->user_id)->update([$coinbal => $totalbal,'payment_status' => 'done']);
                    
                } else {
                    
                     Deposit::where('id', $deposit->id)->update(['confirmations' => $confirmations]);
               }
             
           }
             
       }

    
    
}
