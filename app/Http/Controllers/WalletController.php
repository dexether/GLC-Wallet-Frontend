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
use Laracasts\Flash\Flash;
use Stripe\Stripe;
use Omnipay\Omnipay;

use neto737\BitGoSDK\BitGoSDK;
use neto737\BitGoSDK\BitGoExpress;
use neto737\BitGoSDK\Enum\CurrencyCode;
use Session;


class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware(['sentinel','verify_requirements']);
    }


  public function walletsAddress(Request $request) {
      
           

            $lable = Sentinel::getUser()->first_name.'-'.Sentinel::getUser()->last_name;
            // generate wallet password
            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; // genrate pass
            $walletPassword = substr(str_shuffle(str_repeat($alpha_numeric, 8)), 0, 8); // genrate paa
            
            $setting = Setting::where('setting_key','access_token')->first();
            $token = $setting->setting_value;
            $enterprise = '5b03a4e8af2039c0072287e91086ff31';
            $hostname = '209.97.136.12';
            $port = '80';
            $coin = $request->coin;
            //$coin ='tbtc';
            $bitgoExpress = new BitGoExpress($hostname, $port, $coin);
            $bitgoExpress->accessToken = $token;
            $generateWallet = $bitgoExpress->generateWallet($lable,$walletPassword,NULL,NULL,NULL,$enterprise);
        

            $walletdata = json_encode($generateWallet['id']);
            $walletId = json_decode($walletdata);            
            
            $bitgo = new BitGoSDK($token, $coin, true);
            $bitgo->walletId = $walletId;
            $url ='http://exchange.dsss.in/webhook/bitgo';
            $type = 'transaction';
            $webhook = $bitgo->addWalletWebhook($url,$type);            

            // return json_encode($webhook);
            // die();



        //print_r($data);
        
          if($coin == 'tbtc') {
            $coins = 'bitcoin';
            $walletCoin = 'btc_wallet_id';
          } elseif ($coin == 'teth') {
            $coins = 'ethereum';
            $walletCoin = 'eth_wallet_id';
          } elseif ($coin == 'txrp') {
            $coins = 'ripple';
            $walletCoin = 'xrp_wallet_id';
          } elseif ($coin == 'tltc') {
            $coins = 'litecoin';
            $walletCoin = 'ltc_wallet_id';
          }

   
        $walletsCoinsid = TradeCurrency::where('network', $coins)->first();
      
        if($walletId) {

        $wallet_address = new WalletAddress();
        $wallet_address->user_id = Sentinel::getUser()->id;
        $wallet_address->wallet_lable = $lable;
        $wallet_address->wallet_password = $walletPassword;
        $wallet_address->trade_currency_id = $walletsCoinsid->id;
        $wallet_address->coin = $coin;
        $wallet_address->current = 1;
        $wallet_address->wallet_id = $walletId;
        $wallet_address->save();

        User::where('id', Sentinel::check()->id)->update([$walletCoin => $walletId]);
   
        return redirect()->back();
      
        }  else {
        
        return redirect()->back()->with(['error' => 'Please Try Again !!']);

        }

    }

     public function walletsShowAddress(Request $request) {
         
            $setting = Setting::where('setting_key','access_token')->first();  //v2x504feb3660aa6950200858c866e414a444e53a970964f4de3c9ef630f5849a07
            $token = $setting->setting_value;
            $coin = $request->coin;
            
            
            if($coin == 'tbtc') {
                   $coins = 'bitcoin';
                   $walletId = Sentinel::check()->btc_wallet_id;
              } elseif ($coin == 'teth') {
                   $coins = 'ethereum';
                   $walletId = Sentinel::check()->eth_wallet_id;
              } elseif ($coin == 'txrp') {
                   $coins = 'ripple';
                   $walletId = Sentinel::check()->xrp_wallet_id;
              } elseif ($coin == 'tltc') {
                   $coins = 'litecoin';
                  $walletId = Sentinel::check()->ltc_wallet_id;
              }


            $bitgo = new BitGoSDK($token, $coin, true);
            $bitgo->walletId = $walletId;
            $getWallet = $bitgo->getWallet();
            
            // print_r($getWallet);
            // die();
            
              if (array_key_exists('receiveAddress', $getWallet ) ) {
                  
                  $address = $getWallet['receiveAddress']['address'];
              
              } else { 
                  
                  return redirect()->back()->with(['error' => 'Address will not be immediately, Please Try After few minutes !!']);
              }
            
            // $addressdata = json_encode($getWallet['receiveAddress']['address']); 
            // $address = json_decode($addressdata);
    
            if($address) {
                 WalletAddress::where('wallet_id', $walletId)->update(['address' => $address]);
                 return redirect()->back();
            }  else {
                return redirect()->back()->with(['error' => 'Please Try Again !!']);
            }

     }


    
   public function btcWallet()
    {

         $setting = Setting::where('setting_key','access_token')->first();
         $token = $setting->setting_value;
            
         $coin = 'tbtc';
         $coins = 'bitcoin';
         $walletId = Sentinel::check()->btc_wallet_id;



         
         $bitgo = new BitGoSDK($token, $coin, true);
         $bitgo->walletId = $walletId;
         $getWallet = $bitgo->getWallet();

              if (array_key_exists('receiveAddress', $getWallet ) ) {
                  
                  $address = $getWallet['receiveAddress']['address'];
              
              } else { 

                  return redirect('wallets/btc')->with(['error' => 'Address will not be immediately, Please Try After few minutes !!']);
              }

            if($address) {
                 WalletAddress::where('wallet_id', $walletId)->update(['address' => $address]);
            } 

        
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $btc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $btc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        //try to update user wallet balance
        $wallet = WalletAddress::where('trade_currency_id', $btc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->first();
        return view('wallets.btc.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals', 'wallet'));
    }
    
    


    public function ethWallet()
    {
        
    
          $setting = Setting::where('setting_key','access_token')->first();
         $token = $setting->setting_value;

         $coin = 'teth';
         $coins = 'ethereum';
         $walletId = Sentinel::check()->eth_wallet_id;
         
         $bitgo = new BitGoSDK($token, $coin, true);
         $bitgo->walletId = $walletId;
         $getWallet = $bitgo->getWallet();
            
            
              if (array_key_exists('receiveAddress', $getWallet ) ) {
                  
                  $address = $getWallet['receiveAddress']['address'];
              
              } else { 
                  
                  return redirect('wallets/eth')->with(['error' => 'Address will not be immediately, Please Try After few minutes !!']);
              }
            
    
            if($address) {
                 WalletAddress::where('wallet_id', $walletId)->update(['address' => $address]);
                
            } 
            

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $eth->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $eth->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        //try to update user wallet balance
        $wallet = WalletAddress::where('trade_currency_id', $eth->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->first();
        return view('wallets.eth.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals', 'wallet'));
    }

        public function xrpWallet() {


         $setting = Setting::where('setting_key','access_token')->first();
         $token = $setting->setting_value;
         $coin = 'txrp';
         $coins = 'ripple';
         $walletId = Sentinel::check()->xrp_wallet_id;
         
         $bitgo = new BitGoSDK($token, $coin, true);
         $bitgo->walletId = $walletId;
         $getWallet = $bitgo->getWallet();
            
            
              if (array_key_exists('receiveAddress', $getWallet ) ) {
                  
                  $address = $getWallet['receiveAddress']['address'];
              
              } else { 
                  
                  return redirect('wallets/xrp')->with(['error' => 'Address will not be immediately, Please Try After few minutes !!']);
              }
            
    
            if($address) {
                 WalletAddress::where('wallet_id', $walletId)->update(['address' => $address]);
                
            } 
            
            
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $xrp->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $xrp->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        //try to update user wallet balance
        $wallet = WalletAddress::where('trade_currency_id', $xrp->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->first();
        return view('wallets.xrp.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals', 'wallet'));
    }

     //Litecoin
    public function ltcWallet()
    {
        
       $setting = Setting::where('setting_key','access_token')->first();
         $token = $setting->setting_value;
         $coin = 'tltc';
         $coins = 'litecoin';
         $walletId = Sentinel::check()->ltc_wallet_id;
         
         $bitgo = new BitGoSDK($token, $coin, true);
         $bitgo->walletId = $walletId;
         $getWallet = $bitgo->getWallet();
            
            
              if (array_key_exists('receiveAddress', $getWallet ) ) {
                  
                  $address = $getWallet['receiveAddress']['address'];
              
              } else { 
                  
                  return redirect('wallets/ltc')->with(['error' => 'Address will not be immediately, Please Try After few minutes !!']);
              }

            if($address) {
                 WalletAddress::where('wallet_id', $walletId)->update(['address' => $address]);
                
            } 

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $ltc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $ltc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        //try to update user wallet balance
        $wallet = WalletAddress::where('trade_currency_id', $ltc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->first();
        return view('wallets.ltc.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals', 'wallet'));
    }





     public function sendBtc() {
         
         $usd = TradeCurrency::where('default_currency', 1)->first();
            $btc = TradeCurrency::where('network', "bitcoin")->first();
            $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
            $ltc = TradeCurrency::where('network', "litecoin")->first();
            $xrp = TradeCurrency::where('network', "ripple")->first();
            $eth = TradeCurrency::where('network', "ethereum")->first();
            $fees_percentage = 0;
            $fees_fixed = 0;
            $fees_both = 0;
    
            return view('wallets.btc.withdraw',
                compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth'));
            
     }
     
      
     
       public function sendEth() {
         
         $usd = TradeCurrency::where('default_currency', 1)->first();
            $btc = TradeCurrency::where('network', "bitcoin")->first();
            $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
            $ltc = TradeCurrency::where('network', "litecoin")->first();
            $xrp = TradeCurrency::where('network', "ripple")->first();
            $eth = TradeCurrency::where('network', "ethereum")->first();
            $fees_percentage = 0;
            $fees_fixed = 0;
            $fees_both = 0;
    
            return view('wallets.eth.withdraw',
                compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth'));
            
     }
     
       public function sendXrp() {
         
         $usd = TradeCurrency::where('default_currency', 1)->first();
            $btc = TradeCurrency::where('network', "bitcoin")->first();
            $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
            $ltc = TradeCurrency::where('network', "litecoin")->first();
            $xrp = TradeCurrency::where('network', "ripple")->first();
            $eth = TradeCurrency::where('network', "ethereum")->first();
            $fees_percentage = 0;
            $fees_fixed = 0;
            $fees_both = 0;
    
            return view('wallets.xrp.withdraw',
                compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth'));
            
     }
     
            public function sendLtc() {
         
            $usd = TradeCurrency::where('default_currency', 1)->first();
            $btc = TradeCurrency::where('network', "bitcoin")->first();
            $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
            $ltc = TradeCurrency::where('network', "litecoin")->first();
            $xrp = TradeCurrency::where('network', "ripple")->first();
            $eth = TradeCurrency::where('network', "ethereum")->first();
            $fees_percentage = 0;
            $fees_fixed = 0;
            $fees_both = 0;
    
            return view('wallets.ltc.withdraw',
                compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth'));
            
     }

      public function sendOtp(Request $request) {
        
        $user_id = Sentinel::getuser()->id;
        $users = Sentinel::findById($user_id);
        $credentials = [
            'otp' => mt_rand(100000,999999),
        ];
        
        Sentinel::update($users, $credentials);
         
         
        $sender_id =  Setting::where('setting_key', 'sender_id')->first()->setting_value;
        $SendSMS_api_id =  Setting::where('setting_key', 'SendSMS_api_id')->first()->setting_value;
        $SendSMS_api_password =  Setting::where('setting_key', 'SendSMS_api_password')->first()->setting_value;
        if (Setting::where('setting_key', 'sms_enabled')->first()->setting_value == 1) {
           
           
            $user = Sentinel::findById($user_id);
            $body = Setting::where('setting_key',
                'otp_sms_template')->first()->setting_value;
            $body = str_replace('{otp}', $user->otp, $body);
            $body = trim(strip_tags($body));
            if (!empty($user->phone)) {
                setcookie('otpresend_phone', 1, time() + (1.5*60), "/");
        $url ="https://api.smsala.com/api/SendSMS?api_id=".$SendSMS_api_id."&api_password=".$SendSMS_api_password."&sms_type=T&encoding=T&sender_id=".$sender_id."&phonenumber=".$user->phone."&textmessage=".$body;
            //send sms here
        $url = str_replace(" ", '%20', $url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $ret = curl_exec($ch);
        return "success";
          
      } else {
          
          return "error";
      }
      
        }
        
          
          
          
    }
        

        public function btcSend(Request $request) {
                
              $otp = Sentinel::getUser()->otp;
              if(!$request->otp){
                   return redirect()->back()->with(['error' => 'Please enter OTP..']);
              }
              else if($otp != $request->otp){
                   return redirect()->back()->with(['error' => 'OTP Does not match..']);
              }
                
              $myBTC = Sentinel::getUser()->bitcoin_balance;
              $address = $request->receiver_address;
              $amount = $request->amount;
              $walletid = Sentinel::getUser()->btc_wallet_id;
              $totalbal = $myBTC - $amount;
              
              $setting = Setting::where('setting_key','access_token')->first();
              $token = $setting->setting_value;
         
               if ($myBTC >= $amount) {
    
                $wpass = WalletAddress::where('wallet_id', $walletid)->first();
                $walletPassword = $wpass->wallet_password;
                     
                $hostname = '209.97.136.12';
                $port = 80;
                $coin = 'tbtc';
                
                $bitgo = new BitGoSDK($token, $coin, true);
                $session = $bitgo->getSessionInfo();
                $checkSession = $session['session']; 
              
                if (!array_key_exists('unlock', $checkSession ) ) {
                $bitgo->unlockSession('0000000');
                }
                
                $bitgoExpress = new BitGoExpress($hostname, $port, $coin);
                $bitgoExpress->accessToken = $token;
                $bitgoExpress->walletId = $walletid;
                $satoshiamount = BitGoSDK::toSatoshi($amount);
                $sendTransaction = $bitgoExpress->sendTransaction($address,$satoshiamount,$walletPassword,null,2);
                
                 if (array_key_exists('error', $sendTransaction ) ) {  
                     if($sendTransaction['error'] == 'invalid address') {
                     return redirect()->back()->with(['error' => 'Invalid address!!']);
                     }
                 }
                 
                 if (array_key_exists('txid', $sendTransaction ) ) {  
           
                
                    User::where('id', Sentinel::getUser()->id)->update(['bitcoin_balance'=>$totalbal]);
                    
                    $withdrawal = new Withdrawal();
                    $withdrawal->account_name = 'Send BTC';
                    $withdrawal->transaction_id = $sendTransaction['txid'];
                    $withdrawal->user_id = Sentinel::getUser()->id;
                    $withdrawal->trade_currency_id = '4';
                    $withdrawal->amount = $amount;
                    $withdrawal->sender_address = $address;
                    $withdrawal->status = 'done';
                    $withdrawal->network = 'bitcoin';
                    $withdrawal->save();
                    
                    $txid = $sendTransaction['txid'];
                    Session::flash('success', "Bitcoin Sent! TX ID: $txid");
                    return redirect()->back();
                    
            
                } else if( $sendTransaction['error'] == 'insufficient funds') {
                
                   return redirect()->back()->with(['error' => 'Insufficient funds!!']);
                    
                }  else {
                    
                   return redirect()->back()->with(['error' => 'Please try again!!']);
                     
                }
                
            
            }  else { 
                
                   return redirect()->back()->with(['error' => 'Insufficient funds!!']);
            }
            
        }
        
        
        
        public function ltcSend(Request $request) {
                
              $otp = Sentinel::getUser()->otp;
              if(!$request->otp){
                   return redirect()->back()->with(['error' => 'Please enter OTP..']);
              }
              else if($otp != $request->otp){
                   return redirect()->back()->with(['error' => 'OTP Does not match..']);
              }
              
              $myBal = Sentinel::getUser()->litecoin_balance;
              $address = $request->receiver_address;
              $amount = $request->amount;
              $walletid = Sentinel::getUser()->ltc_wallet_id;
              $totalbal = $myBal - $amount;
              
               $setting = Setting::where('setting_key','access_token')->first();
               $token = $setting->setting_value;
              
               if ($myBal >= $amount) {
    
                $wpass = WalletAddress::where('wallet_id', $walletid)->first();
                $walletPassword = $wpass->wallet_password;
                     
                $hostname = '209.97.136.12';
                $port = 80;
                $coin = 'tltc';
                
                $bitgo = new BitGoSDK($token, $coin, true);
               
                $session = $bitgo->getSessionInfo();
                $checkSession = $session['session']; 
                if (!array_key_exists('unlock', $checkSession ) ) {
                $bitgo->unlockSession('0000000');
                }
                
                $bitgoExpress = new BitGoExpress($hostname, $port, $coin);
                $bitgoExpress->accessToken = $token;
                $bitgoExpress->walletId = $walletid;
                $satoshiamount = BitGoSDK::toSatoshi($amount);
                $sendTransaction = $bitgoExpress->sendTransaction($address,$satoshiamount,$walletPassword,null,2);
                
                 if (array_key_exists('error', $sendTransaction ) ) {  
                     if($sendTransaction['error'] == 'invalid address') {
                     return redirect()->back()->with(['error' => 'Invalid address!!']);
                     }
                 }
                 
                 if (array_key_exists('txid', $sendTransaction ) ) {  
           
                
                    User::where('id', Sentinel::getUser()->id)->update(['litecoin_balance'=>$totalbal]);
                    
                    $withdrawal = new Withdrawal();
                    $withdrawal->account_name = 'Send LTC';
                    $withdrawal->transaction_id = $sendTransaction['txid'];
                    $withdrawal->user_id = Sentinel::getUser()->id;
                    $withdrawal->trade_currency_id = '5';
                    $withdrawal->amount = $amount;
                    $withdrawal->sender_address = $address;
                    $withdrawal->status = 'done';
                    $withdrawal->network = 'litecoin';
                    $withdrawal->save();
                    
                    $txid = $sendTransaction['txid'];
                    Session::flash('success', "Litecoin Sent! TX ID: $txid");
                    return redirect()->back();
                    
                    
            
                } else if( $sendTransaction['error'] == 'insufficient funds') {
                
                   return redirect()->back()->with(['error' => 'Insufficient funds!!']);
                    
                }  else {
                    
                   return redirect()->back()->with(['error' => 'Please try again!!']);
                     
                }
                
            
            }  else { 
                
                   return redirect()->back()->with(['error' => 'Insufficient funds!!']);
            }
            
        }
        
        
         public function ethSend(Request $request) {
                
                 $otp = Sentinel::getUser()->otp;
              if(!$request->otp){
                   return redirect()->back()->with(['error' => 'Please enter OTP..']);
              }
              else if($otp != $request->otp){
                   return redirect()->back()->with(['error' => 'OTP Does not match..']);
              }
              
              
              $myBal = Sentinel::getUser()->ethereum_balance;
              $address = $request->receiver_address;
              $amount = $request->amount;
              $walletid = Sentinel::getUser()->eth_wallet_id;
              $totalbal = $myBal - $amount;
              
               $setting = Setting::where('setting_key','access_token')->first();
               $token = $setting->setting_value;
              
               if ($myBal >= $amount) {
    
                $wpass = WalletAddress::where('wallet_id', $walletid)->first();
                $walletPassword = $wpass->wallet_password;
                     
                $hostname = '209.97.136.12';
                $port = 80;
                $coin = 'teth';
                
                $bitgo = new BitGoSDK($token, $coin, true);
               
                $session = $bitgo->getSessionInfo();
                $checkSession = $session['session']; 
                if (!array_key_exists('unlock', $checkSession ) ) {
                $bitgo->unlockSession('0000000');
                }
                
                $bitgoExpress = new BitGoExpress($hostname, $port, $coin);
                $bitgoExpress->accessToken = $token;
                $bitgoExpress->walletId = $walletid;
               // $satoshiamount = BitGoSDK::toSatoshi($amount);
                $satoshiamount = 1e18 * $amount;
                $sendTransaction = $bitgoExpress->sendTransaction($address,$satoshiamount,$walletPassword,null,2);
                
                if (array_key_exists('error', $sendTransaction ) ) {  
                     if($sendTransaction['error'] == 'invalid address') {
                     return redirect()->back()->with(['error' => 'Invalid address!!']);
                     }
                 }
                 
                 if (array_key_exists('txid', $sendTransaction ) ) {  
           
                
                    User::where('id', Sentinel::getUser()->id)->update(['ethereum_balance'=>$totalbal]);
                    
                    $withdrawal = new Withdrawal();
                    $withdrawal->account_name = 'Send ETH';
                    $withdrawal->transaction_id = $sendTransaction['txid'];
                    $withdrawal->user_id = Sentinel::getUser()->id;
                    $withdrawal->trade_currency_id = '1';
                    $withdrawal->amount = $amount;
                    $withdrawal->sender_address = $address;
                    $withdrawal->status = 'done';
                    $withdrawal->network = 'ethereum';
                    $withdrawal->save();
                    
                    $txid = $sendTransaction['txid'];
                    Session::flash('success', "Ethereum Sent! TX ID: $txid");
                    return redirect()->back();
                    
                    
                    
            
                } else if( $sendTransaction['error'] == 'insufficient funds') {
                
                   return redirect()->back()->with(['error' => 'Insufficient funds!!']);
                    
                }  else {
                    
                   return redirect()->back()->with(['error' => 'Please try again!!']);
                     
                }
                
            
            }  else { 
                
                   return redirect()->back()->with(['error' => 'Insufficient funds!!']);
            }
            
        }
        
        public function xrpSend(Request $request) {
              
                 $otp = Sentinel::getUser()->otp;
              if(!$request->otp){
                   return redirect()->back()->with(['error' => 'Please enter OTP..']);
              }
              else if($otp != $request->otp){
                   return redirect()->back()->with(['error' => 'OTP Does not match..']);
              }
              
              $myBal = Sentinel::getUser()->ripple_balance;
              $address = $request->receiver_address;
              $amount = $request->amount;
              $walletid = Sentinel::getUser()->xrp_wallet_id;
              $totalbal = $myBal - $amount;
              
               $setting = Setting::where('setting_key','access_token')->first();
               $token = $setting->setting_value;
              
               if ($myBal >= $amount) {
    
                $wpass = WalletAddress::where('wallet_id', $walletid)->first();
                $walletPassword = $wpass->wallet_password;
                     
                $hostname = '209.97.136.12';
                $port = 80;
                $coin = 'txrp';
                
                $bitgo = new BitGoSDK($token, $coin, true);
               
                $session = $bitgo->getSessionInfo();
                $checkSession = $session['session']; 
                if (!array_key_exists('unlock', $checkSession ) ) {
                $bitgo->unlockSession('0000000');
                }
                
                $bitgoExpress = new BitGoExpress($hostname, $port, $coin);
                $bitgoExpress->accessToken = $token;
                $bitgoExpress->walletId = $walletid;
                $satoshiamount = $amount * 1e6;
                $sendTransaction = $bitgoExpress->sendTransaction($address,$satoshiamount,$walletPassword,null,2);
                
                
                 if (array_key_exists('error', $sendTransaction ) ) {  
                     if($sendTransaction['error'] == 'invalid address') {
                     return redirect()->back()->with(['error' => 'Invalid address!!']);
                     }
                 }
                 
                 if (array_key_exists('txid', $sendTransaction ) ) {  
           
                
                    User::where('id', Sentinel::getUser()->id)->update(['ripple_balance'=>$totalbal]);
                    
                    $withdrawal = new Withdrawal();
                    $withdrawal->account_name = 'Send XRP';
                    $withdrawal->transaction_id = $sendTransaction['txid'];
                    $withdrawal->user_id = Sentinel::getUser()->id;
                    $withdrawal->trade_currency_id = '2';
                    $withdrawal->amount = $amount;
                    $withdrawal->sender_address = $address;
                    $withdrawal->status = 'done';
                    $withdrawal->network = 'ripple';
                    $withdrawal->save();
                    
                    
                    $txid = $sendTransaction['txid'];
                    Session::flash('success', "Ripple Sent! TX ID: $txid");
                    return redirect()->back();
                    
                    
                    
            
                } else if( $sendTransaction['error'] == 'insufficient funds') {
                
                   return redirect()->back()->with(['error' => 'Insufficient funds!!']);
                    
                }  else {
                    
                   return redirect()->back()->with(['error' => 'Please try again!!']);
                     
                }
                
            
            }  else { 
                
                   return redirect()->back()->with(['error' => 'Insufficient funds!!']);
            }
            
        }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usd()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $usd->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $usd->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();

        return view('wallet.usd.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals'));
    }

    public function deposit_usd()
    {
        $payment_gateways = [];
        foreach (PaymentGateway::where('active', 1)->get() as $key) {
            $payment_gateways[$key->id] = $key->name;
        }
        $bank_accounts = [];
        foreach (UserBankAccount::where('active', 1)->where('user_id', Sentinel::getUser()->id)->get() as $key) {
            $bank_accounts[$key->id] = $key->account_name . "-" . $key->account_number;
        }
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        return view('wallet.usd.deposit',
            compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'payment_gateways', 'bank_accounts'));
    }

    public function get_bank_accounts($id)
    {
        $data = UserBankAccount::where('withdrawal_method_id', $id)->where('user_id', Sentinel::getUser()->id)->get();
        return json_encode($data);
    }

    public function get_gateway_info(Request $request)
    {
        $json = [];
        $payment_gateway = PaymentGateway::find($request->id);
        if ($payment_gateway) {
            $json["success"] = 1;
            $json["system"] = $payment_gateway->system;
            $json["name"] = $payment_gateway->name;
            $json["notes"] = $payment_gateway->notes;
            $json["paypal_email"] = $payment_gateway->paypal_email;
            $json["stripe_secret_key"] = $payment_gateway->stripe_secret_key;
            $json["stripe_publishable_key"] = $payment_gateway->stripe_publishable_key;
        } else {
            $json["success"] = 0;
            $json["msg"] = "Gateway not found";
        }
        return json_encode($json, JSON_UNESCAPED_SLASHES);
    }

    public function withdraw_usd()
    {
        $withdrawal_methods = [];
        foreach (WithdrawalMethod::where('active', 1)->get() as $key) {
            $withdrawal_methods[$key->id] = $key->name;
        }
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $bank_accounts = [];
        foreach (UserBankAccount::where('active', 1)->where('user_id', Sentinel::getUser()->id)->get() as $key) {
            $bank_accounts[$key->id] = $key->account_name . "-" . $key->account_number;
        }
        $fees_percentage = 0;
        $fees_fixed = 0;
        $fees_both = 0;

        return view('wallet.usd.withdraw',
            compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawal_methods','bank_accounts'));
    }

    public function manual_withdraw_usd(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        if ($usd->minimum_amount > 0 && $request->amount < $usd->minimum_amount) {
            Flash::warning(trans('general.amount_less_than_minimum'));
            return redirect()->back();
        }
        if ($usd->maximum_amount > 0 && $request->amount > $usd->maximum_amount) {
            Flash::warning(trans('general.amount_greater_than_maximum'));
            return redirect()->back();
        }
        if ((GeneralHelper::user_usd_balance(Sentinel::getUser()->id) - GeneralHelper::user_usd_locked_balance(Sentinel::getUser()->id)) < ($request->amount)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Sentinel::getUser()->id;
        $withdrawal->account_name = $request->account_name;
        $withdrawal->account_number = $request->account_number;
        $withdrawal->user_bank_account_id = $request->user_bank_account_id;
        $withdrawal->trade_currency_id = $usd->id;
        $withdrawal->withdrawal_method_id = $request->withdrawal_method_id;
        $withdrawal->status = "pending";
        $fees = 0;
        if ($usd->fee_method == "fixed") {
            $fees = $fees + $usd->withdrawal_fixed_fee;
        }
        if ($usd->fee_method == "percentage") {
            $fees = $fees + ($usd->withdrawal_percentage_fee * $request->amount / 100);
        }
        if ($usd->fee_method == "both") {
            $fees = $fees + $usd->withdrawal_fixed_fee + ($usd->withdrawal_percentage_fee * $request->amount / 100);
        }
        $withdrawal->fee = $fees;
        $withdrawal->amount = $request->amount - $fees;
        $withdrawal->save();
        Flash::success(trans('general.manual_withdrawal_success_msg'));
        return redirect('wallet/usd');
    }

    public function stripe_process(Request $request)
    {
        $gateway = PaymentGateway::find($request->stripe_id);
        $stripe = array(
            "secret_key" => $gateway->stripe_secret_key,
            "publishable_key" => $gateway->stripe_publishable_key
        );
        $json = array();
        Stripe::setApiKey($stripe['secret_key']);
        try {
            $token = $request->token;
            $customer = \Stripe\Customer::create(array(
                'email' => Sentinel::getUser()->email,
                'source' => $token
            ));

            $charge = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount' => $request->amount * 100,
                'currency' => 'usd'
            ));
            //payment successful
            $usd = TradeCurrency::where('default_currency', 1)->first();
            $deposit = new Deposit();
            $deposit->user_id = Sentinel::getUser()->id;
            $deposit->amount = $request->amount;
            $deposit->trade_currency_id = $usd->id;
            $deposit->deposit_method_id = $request->stripe_id;
            $deposit->status = "done";
            $deposit->notes = "Paid via stripe";
            $deposit->save();
            event(new DepositReceived($deposit));
            $json["success"] = 1;
            $json["msg"] = "Successfully Paid";
        } catch (\Exception $e) {
            $json["success"] = 0;
            $json["msg"] = "An error occurred";
        }
    }

    public function manual_deposit_usd(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $deposit = new Deposit();
        $deposit->user_id = Sentinel::getUser()->id;
        $deposit->amount = $request->amount;
        $deposit->account_name = $request->account_name;
        $deposit->account_number = $request->account_number;
        $deposit->trade_currency_id = $usd->id;
        $deposit->user_bank_account_id = $request->user_bank_account_id;
        $deposit->deposit_method_id = $request->deposit_method_id;
        $deposit->status = "pending";
        $deposit->notes = "Offline method";
        $deposit->save();
        Flash::success(trans('general.manual_deposit_success_msg'));
        return redirect('wallet/usd');
    }

    public function deposit_done()
    {
        Flash::success(trans('general.deposit_success'));
        return redirect('wallet/usd');
    }

    public function paypal_ipn(Request $request)
    {
        // read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
// post back to PayPal system to validate
        $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

        $fp = fsockopen('ssl://www.paypal.com', 443, $errno, $errstr, 30);


        if (!$fp) {
// HTTP ERROR
        } else {
            fputs($fp, $header . $req);
            while (!feof($fp)) {
                $res = fgets($fp, 1024);
                if (strcmp($res, "VERIFIED") == 0) {

// PAYMENT VALIDATED & VERIFIED!
                    $item_name = $request['item_name'];
                    $item_number = $request['item_number'];
                    $payment_status = $request['payment_status'];
                    $payment_amount = $request['mc_gross'];
                    $payment_currency = $request['mc_currency'];
                    $txn_id = $request['txn_id'];
                    $receiver_email = $request['receiver_email'];
                    $payer_email = $request['payer_email'];
                    $notes = 'Paypal: txn_id=' . $txn_id . '.<br>Payer Email:' . $payer_email . '.<br>Currency:' . $payment_currency;
                    if ($payment_status == 'Completed' || $payment_status == 'Processed' || $payment_status == 'Sent' || $payment_status == 'Pending') {
                        $usd = TradeCurrency::where('default_currency', 1)->first();
                        $deposit = new Deposit();
                        $deposit->user_id = $item_number;
                        $deposit->amount = $payment_amount;
                        $deposit->trade_currency_id = $usd->id;
                        $deposit->deposit_method_id = 1;
                        $deposit->status = "done";
                        $deposit->notes = $notes;
                        $deposit->save();
                        event(new DepositReceived($deposit));
                        //notify admin


                        //notify client that we have received payment
                    }

                } else {
                    if (strcmp($res, "INVALID") == 0) {

// PAYMENT INVALID & INVESTIGATE MANUALY!
                        //notify admin that payment was unsuccessful

                    }
                }
            }
            fclose($fp);
        }
    }

    public function btc()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $btc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $btc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        //try to update user wallet balance
        $wallet = WalletAddress::where('trade_currency_id', $btc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->first();
        return view('wallet.btc.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals', 'wallet'));
    }

    public function withdraw_btc()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $fees_percentage = 0;
        $fees_fixed = 0;
        $fees_both = 0;

        return view('wallet.btc.withdraw',
            compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth'));
    }

    public function manual_withdraw_btc(Request $request)
    {
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        if ($btc->minimum_amount > 0 && $request->amount < $btc->minimum_amount) {
            Flash::warning(trans('general.amount_less_than_minimum'));
            return redirect()->back();
        }
        if ($btc->maximum_amount > 0 && $request->amount > $btc->maximum_amount) {
            Flash::warning(trans('general.amount_greater_than_maximum'));
            return redirect()->back();
        }
        if ((GeneralHelper::user_btc_balance(Sentinel::getUser()->id) - GeneralHelper::user_btc_locked_balance(Sentinel::getUser()->id)) < ($request->amount)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Sentinel::getUser()->id;
        $withdrawal->name = $request->name;
        $withdrawal->receiver_address = $request->receiver_address;
        $withdrawal->trade_currency_id = $btc->id;
        $withdrawal->withdrawal_method_id = "";
        $withdrawal->status = "pending";
        $withdrawal->network = "bitcoin";
        $fees = 0;
        if ($btc->fee_method == "fixed") {
            $fees = $fees + $btc->withdrawal_fixed_fee;
        }
        if ($btc->fee_method == "percentage") {
            $fees = $fees + ($btc->withdrawal_percentage_fee * $request->amount / 100);
        }
        if ($btc->fee_method == "both") {
            $fees = $fees + $btc->withdrawal_fixed_fee + ($btc->withdrawal_percentage_fee * $request->amount / 100);
        }
        $withdrawal->fee = $fees;
        $withdrawal->amount = $request->amount - $fees;
        $withdrawal->save();
        event(new WithdrawalRequest($withdrawal));
        Flash::success(trans('general.manual_withdrawal_success_msg'));
        return redirect('wallet/btc');
    }

    //Litecoin
    public function ltc()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $ltc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $ltc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        //try to update user wallet balance
        $wallet = WalletAddress::where('trade_currency_id', $ltc->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->first();
        return view('wallet.ltc.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals', 'wallet'));
    }

    public function withdraw_ltc()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $fees_percentage = 0;
        $fees_fixed = 0;
        $fees_both = 0;

        return view('wallet.ltc.withdraw',
            compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth'));
    }

    public function manual_withdraw_ltc(Request $request)
    {
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        if ($ltc->minimum_amount > 0 && $request->amount < $ltc->minimum_amount) {
            Flash::warning(trans('general.amount_less_than_minimum'));
            return redirect()->back();
        }
        if ($ltc->maximum_amount > 0 && $request->amount > $ltc->maximum_amount) {
            Flash::warning(trans('general.amount_greater_than_maximum'));
            return redirect()->back();
        }
        if ((GeneralHelper::user_ltc_balance(Sentinel::getUser()->id) - GeneralHelper::user_ltc_locked_balance(Sentinel::getUser()->id)) < ($request->amount)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Sentinel::getUser()->id;
        $withdrawal->name = $request->name;
        $withdrawal->receiver_address = $request->receiver_address;
        $withdrawal->trade_currency_id = $ltc->id;
        $withdrawal->withdrawal_method_id = "";
        $withdrawal->status = "pending";
        $withdrawal->network = "litecoin";
        $fees = 0;
        if ($ltc->fee_method == "fixed") {
            $fees = $fees + $ltc->withdrawal_fixed_fee;
        }
        if ($ltc->fee_method == "percentage") {
            $fees = $fees + ($ltc->withdrawal_percentage_fee * $request->amount / 100);
        }
        if ($ltc->fee_method == "both") {
            $fees = $fees + $ltc->withdrawal_fixed_fee + ($ltc->withdrawal_percentage_fee * $request->amount / 100);
        }
        $withdrawal->fee = $fees;
        $withdrawal->amount = $request->amount - $fees;
        $withdrawal->save();
        event(new WithdrawalRequest($withdrawal));
        Flash::success(trans('general.manual_withdrawal_success_msg'));
        return redirect('wallet/ltc');
    }

    //Dogecoin
    public function dogecoin()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $dogecoin->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $dogecoin->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        //try to update user wallet balance
        $wallet = WalletAddress::where('trade_currency_id', $dogecoin->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->first();
        return view('wallet.dogecoin.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals', 'wallet'));
    }

    public function withdraw_dogecoin()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $fees_percentage = 0;
        $fees_fixed = 0;
        $fees_both = 0;

        return view('wallet.dogecoin.withdraw',
            compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth'));
    }

    public function manual_withdraw_dogecoin(Request $request)
    {
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        if ($dogecoin->minimum_amount > 0 && $request->amount < $dogecoin->minimum_amount) {
            Flash::warning(trans('general.amount_less_than_minimum'));
            return redirect()->back();
        }
        if ($dogecoin->maximum_amount > 0 && $request->amount > $dogecoin->maximum_amount) {
            Flash::warning(trans('general.amount_greater_than_maximum'));
            return redirect()->back();
        }
        if ((GeneralHelper::user_dogecoin_balance(Sentinel::getUser()->id) - GeneralHelper::user_dogecoin_locked_balance(Sentinel::getUser()->id)) < ($request->amount)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Sentinel::getUser()->id;
        $withdrawal->name = $request->name;
        $withdrawal->receiver_address = $request->receiver_address;
        $withdrawal->trade_currency_id = $dogecoin->id;
        $withdrawal->withdrawal_method_id = "";
        $withdrawal->status = "pending";
        $withdrawal->network = "dogecoin";
        $fees = 0;
        if ($dogecoin->fee_method == "fixed") {
            $fees = $fees + $dogecoin->withdrawal_fixed_fee;
        }
        if ($dogecoin->fee_method == "percentage") {
            $fees = $fees + ($dogecoin->withdrawal_percentage_fee * $request->amount / 100);
        }
        if ($dogecoin->fee_method == "both") {
            $fees = $fees + $dogecoin->withdrawal_fixed_fee + ($dogecoin->withdrawal_percentage_fee * $request->amount / 100);
        }
        $withdrawal->fee = $fees;
        $withdrawal->amount = $request->amount - $fees;
        $withdrawal->save();
        event(new WithdrawalRequest($withdrawal));
        Flash::success(trans('general.manual_withdrawal_success_msg'));
        return redirect('wallet/dogecoin');
    }

    public function eth()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $eth->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $eth->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        //try to update user wallet balance
        $wallet = WalletAddress::where('trade_currency_id', $eth->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->first();
        return view('wallet.eth.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals', 'wallet'));
    }

    public function withdraw_eth()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $fees_percentage = 0;
        $fees_fixed = 0;
        $fees_both = 0;

        return view('wallet.eth.withdraw',
            compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth'));
    }

    public function manual_withdraw_eth(Request $request)
    {
        $eth = TradeCurrency::where('network', "ethereum")->first();
        if ($eth->minimum_amount > 0 && $request->amount < $eth->minimum_amount) {
            Flash::warning(trans('general.amount_less_than_minimum'));
            return redirect()->back();
        }
        if ($eth->maximum_amount > 0 && $request->amount > $eth->maximum_amount) {
            Flash::warning(trans('general.amount_greater_than_maximum'));
            return redirect()->back();
        }
        if ((GeneralHelper::user_eth_balance(Sentinel::getUser()->id) - GeneralHelper::user_eth_locked_balance(Sentinel::getUser()->id)) < ($request->amount)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Sentinel::getUser()->id;
        $withdrawal->name = $request->name;
        $withdrawal->receiver_address = $request->receiver_address;
        $withdrawal->trade_currency_id = $eth->id;
        $withdrawal->withdrawal_method_id = "";
        $withdrawal->status = "pending";
        $withdrawal->network = "ethereum";
        $fees = 0;
        if ($eth->fee_method == "fixed") {
            $fees = $fees + $eth->withdrawal_fixed_fee;
        }
        if ($eth->fee_method == "percentage") {
            $fees = $fees + ($eth->withdrawal_percentage_fee * $request->amount / 100);
        }
        if ($eth->fee_method == "both") {
            $fees = $fees + $eth->withdrawal_fixed_fee + ($eth->withdrawal_percentage_fee * $request->amount / 100);
        }
        $withdrawal->fee = $fees;
        $withdrawal->amount = $request->amount - $fees;
        $withdrawal->save();
        event(new WithdrawalRequest($withdrawal));
        Flash::success(trans('general.manual_withdrawal_success_msg'));
        return redirect('wallet/eth');
    }

    public function xrp()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $xrp->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $xrp->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        //try to update user wallet balance
        $wallet = WalletAddress::where('trade_currency_id', $xrp->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->first();
        return view('wallet.xrp.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals', 'wallet'));
    }

    public function withdraw_xrp()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $fees_percentage = 0;
        $fees_fixed = 0;
        $fees_both = 0;

        return view('wallet.xrp.withdraw',
            compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth'));
    }

    public function manual_withdraw_xrp(Request $request)
    {
        $xrp = TradeCurrency::where('network', "ethereum")->first();
        if ($xrp->minimum_amount > 0 && $request->amount < $xrp->minimum_amount) {
            Flash::warning(trans('general.amount_less_than_minimum'));
            return redirect()->back();
        }
        if ($xrp->maximum_amount > 0 && $request->amount > $xrp->maximum_amount) {
            Flash::warning(trans('general.amount_greater_than_maximum'));
            return redirect()->back();
        }
        if ((GeneralHelper::user_xrp_balance(Sentinel::getUser()->id) - GeneralHelper::user_xrp_locked_balance(Sentinel::getUser()->id)) < ($request->amount)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Sentinel::getUser()->id;
        $withdrawal->name = $request->name;
        $withdrawal->receiver_address = $request->receiver_address;
        $withdrawal->trade_currency_id = $xrp->id;
        $withdrawal->withdrawal_method_id = "";
        $withdrawal->status = "pending";
        $withdrawal->network = "ripple";
        $fees = 0;
        if ($xrp->fee_method == "fixed") {
            $fees = $fees + $xrp->withdrawal_fixed_fee;
        }
        if ($xrp->fee_method == "percentage") {
            $fees = $fees + ($xrp->withdrawal_percentage_fee * $request->amount / 100);
        }
        if ($xrp->fee_method == "both") {
            $fees = $fees + $xrp->withdrawal_fixed_fee + ($xrp->withdrawal_percentage_fee * $request->amount / 100);
        }
        $withdrawal->fee = $fees;
        $withdrawal->amount = $request->amount - $fees;
        $withdrawal->save();
        event(new WithdrawalRequest($withdrawal));
        Flash::success(trans('general.manual_withdrawal_success_msg'));
        return redirect('wallet/eth');
    }

    public function cancel_deposit($id)
    {
        $deposit = Deposit::find($id);
        if ($deposit->user_id != Sentinel::getUser()->id) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $deposit->status = "cancelled";
        $deposit->save();
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function cancel_withdrawal($id)
    {
        $withdrawal = Withdrawal::find($id);
        if ($withdrawal->user_id != Sentinel::getUser()->id) {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $withdrawal->status = "cancelled";
        $withdrawal->save();
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

//generate wallet
    public function generate_address(Request $request)
    {
        if ($request->coin == "btc") {
            $btc = TradeCurrency::where('network', "bitcoin")->first();
            if (Setting::where('setting_key',
                    'wallet_address_limit')->first()->setting_value > WalletAddress::where('user_id',
                    Sentinel::getUser()->id)->where('trade_currency_id', $btc->id)->count()
            ) {
                if (Setting::where('setting_key',
                        'wallet_address_source')->first()->setting_value == "1"
                ) {
                    //use block io
                    $block_io = new \BlockIo($btc->api_key, $btc->secret_key, 2);
                    $address = $block_io->get_new_address();
                    if ($address->status == "success") {
                        $wallet_address = new WalletAddress();
                        $wallet_address->user_id = Sentinel::getUser()->id;
                        $wallet_address->trade_currency_id = $btc->id;
                        $wallet_address->address = $address->data->address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                        //set others to not current
                        foreach (WalletAddress::where('user_id', Sentinel::getUser()->id)->where('trade_currency_id',
                            $btc->id)->where('id', '!=', $wallet_address->id)->where('current', 1)->get() as $key) {
                            $wallet_address = WalletAddress::find($key->id);
                            $wallet_address->current = 0;
                            $wallet_address->save();
                        }
                        Flash::success(trans('general.address_generation_success'));
                        return redirect()->back();
                    } else {
                        Flash::warning(trans('general.address_generation_failed'));
                        return redirect()->back();
                    }
                } else {
                    //check if there is a free wallet address
                    $address = "";
                    foreach (OfflineWallet::where('trade_currency_id', $btc->id)->where('active',
                        1)->orderBy('created_at', 'asc')->get() as $key) {
                        if (WalletAddress::where('address', $key->address)->count() == 0) {
                            //address not in use
                            $address = $key->address;
                            break;
                        }
                    }
                    if (!empty($address)) {
                        $wallet_address = new WalletAddress();
                        $wallet_address->user_id = Sentinel::getUser()->id;
                        $wallet_address->trade_currency_id = $btc->id;
                        $wallet_address->address = $address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                        //set others to not current
                        foreach (WalletAddress::where('user_id', Sentinel::getUser()->id)->where('trade_currency_id',
                            $btc->id)->where('id', '!=', $wallet_address->id)->where('current', 1)->get() as $key) {
                            $wallet_address = WalletAddress::find($key->id);
                            $wallet_address->current = 0;
                            $wallet_address->save();
                        }
                        Flash::success(trans('general.address_generation_success'));
                        return redirect()->back();
                    } else {
                        Flash::warning(trans('general.address_generation_failed'));
                        return redirect()->back();
                    }
                }
            } else {
                Flash::warning(trans('general.maximum_wallet_address_reached'));
                return redirect()->back();
            }
        }
        if ($request->coin == "ltc") {
            $ltc = TradeCurrency::where('network', "litecoin")->first();
            if (Setting::where('setting_key',
                    'wallet_address_limit')->first()->setting_value > WalletAddress::where('user_id',
                    Sentinel::getUser()->id)->where('trade_currency_id', $ltc->id)->count()
            ) {
                if (Setting::where('setting_key',
                        'wallet_address_source')->first()->setting_value == "1"
                ) {
                    //use block io
                    $block_io = new \BlockIo($ltc->api_key, $ltc->secret_key, 2);
                    $address = $block_io->get_new_address();
                    if ($address->status == "success") {
                        $wallet_address = new WalletAddress();
                        $wallet_address->user_id = Sentinel::getUser()->id;
                        $wallet_address->trade_currency_id = $ltc->id;
                        $wallet_address->address = $address->data->address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                        //set others to not current
                        foreach (WalletAddress::where('user_id', Sentinel::getUser()->id)->where('trade_currency_id',
                            $ltc->id)->where('id', '!=', $wallet_address->id)->where('current', 1)->get() as $key) {
                            $wallet_address = WalletAddress::find($key->id);
                            $wallet_address->current = 0;
                            $wallet_address->save();
                        }
                        Flash::success(trans('general.address_generation_success'));
                        return redirect()->back();
                    } else {
                        Flash::warning(trans('general.address_generation_failed'));
                        return redirect()->back();
                    }
                } else {
                    //check if there is a free wallet address
                    $address = "";
                    foreach (OfflineWallet::where('trade_currency_id', $ltc->id)->where('active',
                        1)->orderBy('created_at', 'asc')->get() as $key) {
                        if (WalletAddress::where('address', $key->address)->count() == 0) {
                            //address not in use
                            $address = $key->address;
                            break;
                        }
                    }
                    if (!empty($address)) {
                        $wallet_address = new WalletAddress();
                        $wallet_address->user_id = Sentinel::getUser()->id;
                        $wallet_address->trade_currency_id = $ltc->id;
                        $wallet_address->address = $address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                        //set others to not current
                        foreach (WalletAddress::where('user_id', Sentinel::getUser()->id)->where('trade_currency_id',
                            $ltc->id)->where('id', '!=', $wallet_address->id)->where('current', 1)->get() as $key) {
                            $wallet_address = WalletAddress::find($key->id);
                            $wallet_address->current = 0;
                            $wallet_address->save();
                        }
                        Flash::success(trans('general.address_generation_success'));
                        return redirect()->back();
                    } else {
                        Flash::warning(trans('general.address_generation_failed'));
                        return redirect()->back();
                    }
                }
            } else {
                Flash::warning(trans('general.maximum_wallet_address_reached'));
                return redirect()->back();
            }
        }
        if ($request->coin == "dogecoin") {
            $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
            if (Setting::where('setting_key',
                    'wallet_address_limit')->first()->setting_value > WalletAddress::where('user_id',
                    Sentinel::getUser()->id)->where('trade_currency_id', $dogecoin->id)->count()
            ) {
                if (Setting::where('setting_key',
                        'wallet_address_source')->first()->setting_value == "1"
                ) {
                    //use block io
                    $block_io = new \BlockIo($dogecoin->api_key, $dogecoin->secret_key, 2);
                    $address = $block_io->get_new_address();
                    if ($address->status == "success") {
                        $wallet_address = new WalletAddress();
                        $wallet_address->user_id = Sentinel::getUser()->id;
                        $wallet_address->trade_currency_id = $dogecoin->id;
                        $wallet_address->address = $address->data->address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                        //set others to not current
                        foreach (WalletAddress::where('user_id', Sentinel::getUser()->id)->where('trade_currency_id',
                            $dogecoin->id)->where('id', '!=', $wallet_address->id)->where('current',
                            1)->get() as $key) {
                            $wallet_address = WalletAddress::find($key->id);
                            $wallet_address->current = 0;
                            $wallet_address->save();
                        }
                        Flash::success(trans('general.address_generation_success'));
                        return redirect()->back();
                    } else {
                        Flash::warning(trans('general.address_generation_failed'));
                        return redirect()->back();
                    }
                } else {
                    //check if there is a free wallet address
                    $address = "";
                    foreach (OfflineWallet::where('trade_currency_id', $dogecoin->id)->where('active',
                        1)->orderBy('created_at', 'asc')->get() as $key) {
                        if (WalletAddress::where('address', $key->address)->count() == 0) {
                            //address not in use
                            $address = $key->address;
                            break;
                        }
                    }
                    if (!empty($address)) {
                        $wallet_address = new WalletAddress();
                        $wallet_address->user_id = Sentinel::getUser()->id;
                        $wallet_address->trade_currency_id = $dogecoin->id;
                        $wallet_address->address = $address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                        //set others to not current
                        foreach (WalletAddress::where('user_id', Sentinel::getUser()->id)->where('trade_currency_id',
                            $dogecoin->id)->where('id', '!=', $wallet_address->id)->where('current',
                            1)->get() as $key) {
                            $wallet_address = WalletAddress::find($key->id);
                            $wallet_address->current = 0;
                            $wallet_address->save();
                        }
                        Flash::success(trans('general.address_generation_success'));
                        return redirect()->back();
                    } else {
                        Flash::warning(trans('general.address_generation_failed'));
                        return redirect()->back();
                    }
                }
            } else {
                Flash::warning(trans('general.maximum_wallet_address_reached'));
                return redirect()->back();
            }
        }
        if ($request->coin == "eth") {
            $eth = TradeCurrency::where('network', "ethereum")->first();
            if (Setting::where('setting_key',
                    'wallet_address_limit')->first()->setting_value > WalletAddress::where('user_id',
                    Sentinel::getUser()->id)->where('trade_currency_id', $eth->id)->count()
            ) {
                //offline wallets for ethereum
                //check if there is a free wallet address
                $address = "";
                foreach (OfflineWallet::where('trade_currency_id', $eth->id)->where('active',
                    1)->orderBy('created_at', 'asc')->get() as $key) {
                    if (WalletAddress::where('address', $key->address)->count() == 0) {
                        //address not in use
                        $address = $key->address;
                        break;
                    }
                }
                if (!empty($address)) {
                    $wallet_address = new WalletAddress();
                    $wallet_address->user_id = Sentinel::getUser()->id;
                    $wallet_address->trade_currency_id = $eth->id;
                    $wallet_address->address = $address;
                    $wallet_address->current = 1;
                    $wallet_address->save();
                    //set others to not current
                    foreach (WalletAddress::where('user_id', Sentinel::getUser()->id)->where('trade_currency_id',
                        $eth->id)->where('id', '!=', $wallet_address->id)->where('current',
                        1)->get() as $key) {
                        $wallet_address = WalletAddress::find($key->id);
                        $wallet_address->current = 0;
                        $wallet_address->save();
                    }
                    Flash::success(trans('general.address_generation_success'));
                    return redirect()->back();
                } else {
                    Flash::warning(trans('general.address_generation_failed'));
                    return redirect()->back();
                }
            } else {
                Flash::warning(trans('general.maximum_wallet_address_reached'));
                return redirect()->back();
            }
        }
        if ($request->coin == "xrp") {
            $xrp = TradeCurrency::where('network', "ripple")->first();
            if (Setting::where('setting_key',
                    'wallet_address_limit')->first()->setting_value > WalletAddress::where('user_id',
                    Sentinel::getUser()->id)->where('trade_currency_id', $xrp->id)->count()
            ) {
                //offline wallets for ripple
                //check if there is a free wallet address
                $address = "";
                foreach (OfflineWallet::where('trade_currency_id', $xrp->id)->where('active',
                    1)->orderBy('created_at', 'asc')->get() as $key) {
                    if (WalletAddress::where('address', $key->address)->count() == 0) {
                        //address not in use
                        $address = $key->address;
                        break;
                    }
                }
                if (!empty($address)) {
                    $wallet_address = new WalletAddress();
                    $wallet_address->user_id = Sentinel::getUser()->id;
                    $wallet_address->trade_currency_id = $xrp->id;
                    $wallet_address->address = $address;
                    $wallet_address->current = 1;
                    $wallet_address->save();
                    //set others to not current
                    foreach (WalletAddress::where('user_id', Sentinel::getUser()->id)->where('trade_currency_id',
                        $xrp->id)->where('id', '!=', $wallet_address->id)->where('current',
                        1)->get() as $key) {
                        $wallet_address = WalletAddress::find($key->id);
                        $wallet_address->current = 0;
                        $wallet_address->save();
                    }
                    Flash::success(trans('general.address_generation_success'));
                    return redirect()->back();
                } else {
                    Flash::warning(trans('general.address_generation_failed'));
                    return redirect()->back();
                }
            } else {
                Flash::warning(trans('general.maximum_wallet_address_reached'));
                return redirect()->back();
            }
        }
    }
    public function aed()
    {

        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $deposits = Deposit::where('trade_currency_id', $usd->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $withdrawals = Withdrawal::where('trade_currency_id', $usd->id)->where('user_id',
            Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();

        return view('wallets.aed.data',
            compact('deposits', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawals'));
    }


    public function withdraw_aed()
    {
        $withdrawal_methods = [];
        foreach (WithdrawalMethod::where('active', 1)->get() as $key) {
            $withdrawal_methods[$key->id] = $key->name;
        }
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $bank_accounts = [];
        foreach (UserBankAccount::where('active', 1)->where('user_id', Sentinel::getUser()->id)->get() as $key) {
            $bank_accounts[$key->id] = $key->account_name . "-" . $key->account_number;
        }
        $fees_percentage = 0;
        $fees_fixed = 0;
        $fees_both = 0;

        return view('wallets.aed.withdraw',
            compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'withdrawal_methods','bank_accounts'));

    }

    public function manual_withdraw_aed(Request $request)
    {
           $bankaccount = UserBankAccount::where('user_id',Sentinel::getuser()->id)->where('id',$request->user_bank_account_id)->first();
        if(count($bankaccount) <= 0)
        { Flash::warning(trans('general.bank_account_not_found'));
            return redirect()->back();
        }

        $usd = TradeCurrency::where('default_currency', 1)->first();
        if ($usd->minimum_amount > 0 && $request->amount < $usd->minimum_amount) {
            Flash::warning(trans('general.amount_less_than_minimum'));
            return redirect()->back();
        }

        if ($usd->maximum_amount > 0 && $request->amount > $usd->maximum_amount) {
            Flash::warning(trans('general.amount_greater_than_maximum'));
            return redirect()->back();
        }

          $address = WalletAddress::where('user_id',Sentinel::getuser()->id)->where('coin','aed')->first();
        if( count($address)<=0)
        {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        if ( $address->balance < ($request->amount)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }

        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Sentinel::getUser()->id;
//        $withdrawal->account_name = $request->account_name;
//        $withdrawal->account_number = $request->account_number;
        $withdrawal->user_bank_account_id = $request->user_bank_account_id;
        $withdrawal->trade_currency_id = $usd->id;
        $withdrawal->withdrawal_method_id = $request->withdrawal_method_id;
        $withdrawal->status = "pending";


        $fees = 0;
        if ($usd->fee_method == "fixed") {
            $fees = $fees + $usd->withdrawal_fixed_fee;
        }
        if ($usd->fee_method == "percentage") {
            $fees = $fees + ($usd->withdrawal_percentage_fee * $request->amount / 100);
        }
        if ($usd->fee_method == "both") {
            $fees = $fees + $usd->withdrawal_fixed_fee + ($usd->withdrawal_percentage_fee * $request->amount / 100);
        }
        $withdrawal->fee = $fees;
        $withdrawal->amount = $request->amount - $fees;
        $withdrawal->total = $request->amount;
        $withdrawal->network = 'aed';
        $withdrawal->address = $bankaccount->bank_name;
        $withdrawal->account_name = $bankaccount->account_name;
        $withdrawal->account_number = $bankaccount->account_number;
        $withdrawal->transaction_id = str_random(40);
        $withdrawal->save();
        $address->balance = $address->balance- $request->amount;
        $address->save();

        Flash::success(trans('general.manual_withdrawal_success_msg'));
        return redirect('wallets/aed');
    }

    public function deposit_aed()
    {
         $payment = PaymentGateway::where('active',1)->first();
        $payment_gateways = [];
        foreach (PaymentGateway::where('active', 1)->get() as $key) {
            $payment_gateways[$key->id] = $key->name;
        }
        $bank_accounts = [];
        foreach (UserBankAccount::where('active', 1)->where('user_id', Sentinel::getUser()->id)->get() as $key) {
            $bank_accounts[$key->id] = $key->account_name . "-" . $key->account_number;
        }
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        return view('wallets.aed.deposit',
            compact('usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'payment_gateways', 'bank_accounts','payment'));
    }

    public function twocheckout(Request $request)
    {

         $payment = PaymentGateway::where('active',1)->first();

        $this->validate($request,[
            'amount'=>'required|numeric',
            'token'=>'required',
        ]);

        try {

            $deposit = new Deposit();
            $deposit->user_id = Sentinel::getUser()->id;
            $deposit->amount = $request->amount;
            $deposit->trade_currency_id = 3;
            $deposit->deposit_method_id = 1;
            $deposit->status = "pending";
            $deposit->account_name = "AED Deposit ";
            $deposit->notes = "Paid via 2checkout";
            $deposit->save();

            $gateway = Omnipay::create('TwoCheckoutPlus_Token');
            $gateway->setAccountNumber($payment->supplier_id);
            $gateway->setTestMode($payment->type);
            $gateway->setPrivateKey($payment->stripe_secret_key);

             $user = Sentinel::getuser();

            $formData = array(
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
                "email" => $user->email,
                'billingAddress1' => $user->address ==""? 'address':$user->address,
                'billingAddress2' => "address",
                'billingCity' => "Columbus",
                'billingPostcode' => 43206,
                'billingState' => "OH",
                'billingCountry' => "USA",
            );

            $purchase_request_data = array(
                'card' => $formData,
                'token' => $request->token,
                'transactionId' => time(),
                'currency' => 'AED',
                'amount' =>  sprintf("%4.2f", $request->amount),
                "merchantOrderId" => "123",
            );

            $response = $gateway->purchase($purchase_request_data)->send();

            if ($response->isSuccessful()) {
                $transaction_ref = $response->getTransactionReference();

                $deposit = Deposit::find($deposit->id);
                $deposit->status = "done";
                $deposit->transaction_id = $transaction_ref;
                $deposit->save();
                $wa = WalletAddress::where('user_id',Sentinel::getUser()->id)->where('coin','AED')->first();
                if($wa) {
                    $wa = WalletAddress::where('user_id', Sentinel::getUser()->id)->where('coin', 'AED')->first();
                    $wa->balance = $wa->balance + $request->amount;
                    $wa->save();

                    Flash::success(trans('general.deposit_success'));
                    return redirect('wallets/aed');
                }
                else {

                    $wa = new WalletAddress();
                    $wa->user_id = Sentinel::getUser()->id;
                    $wa->coin = 'AED';
                    $wa->trade_currency_id = 3;
                    $wa->balance = $request->amount;
                    $wa->save();

                    Flash::success(trans('general.deposit_success'));
                    return redirect('wallets/aed');
                }

              ;

            } else {
                 $error = $response->getMessage();
                $deposit = Deposit::find($deposit->id);
                $deposit->status = "cancelled";
                $deposit->save();


                Flash::warning($error);
                return redirect('wallets/aed');
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

}
