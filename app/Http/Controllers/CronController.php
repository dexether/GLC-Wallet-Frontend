<?php

namespace App\Http\Controllers;

use Aloha\Twilio\Twilio;
use App\Helpers\GeneralHelper;
use App\Helpers\Infobip;
use App\Helpers\RouteSms;
use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\Deposit;
use App\Models\Email;
use App\Models\Expense;
use App\Models\Loan;
use App\Models\LoanOverduePenalty;
use App\Models\LoanRepayment;
use App\Models\LoanSchedule;
use App\Models\OrderBook;
use App\Models\Payroll;
use App\Models\PayrollMeta;
use App\Models\PayrollTemplateMeta;
use App\Models\Saving;
use App\Models\SavingProduct;
use App\Models\SavingTransaction;
use App\Models\Setting;
use App\Models\Sms;
use App\Models\TradeCurrency;
use App\Models\User;
use App\Models\WalletAddress;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Clickatell\Rest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use PDF;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use App\Http\Requests;

class CronController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Setting::where('setting_key', 'enable_cron')->first()->setting_value == 0) {
            //someone attempted to run con job but it is disabled
            Mail::raw('Someone attempted to run con job but it is disabled, please enable it in settings',
                function ($message) {
                    $message->from(Setting::where('setting_key', 'company_email')->first()->setting_value,
                        Setting::where('setting_key', 'company_name')->first()->setting_value);
                    $message->to(Setting::where('setting_key', 'company_email')->first()->setting_value);
                    $headers = $message->getHeaders();
                    $message->setContentType('text/html');
                    $message->setSubject('Cron Job Failed');

                });
            return 'cron job disabled';
        } else {


            //matching engine
            foreach (OrderBook::where('status', 'pending')->get() as $key) {
                if (OrderBook::where('status', 'pending')->where('network', $key->network)->where('order_type', '!=',
                        $key->order_type)->where('volume', $key->sell_volume)->where('user_id', '!=',
                        $key->user_id)->where('price',
                        $key->sell_price)->count() > 0
                ) {
                    //we have a match
                    $buy = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                        $key->network)->where('order_type', '!=',
                        $key->order_type)->where('volume', $key->sell_volume)->where('price',
                        $key->sell_price)->where('user_id', '!=', $key->user_id)->orderBy('created_at',
                        'asc')->first()->id);
                    $buy->linked_order_id = $key->id;
                    $buy->status = "done";
                    $buy->save();
                    $sell = OrderBook::find($key->id);
                    $sell->status = "done";
                    $sell->linked_order_id = $sell->id;
                    $sell->save();
                }
            }
            //update user wallet transactions
            foreach (User::join('wallet_addresses', 'users.id', '=',
                'wallet_addresses.user_id')->get() as $key) {
                $client = new Client();
                $trade_currency = TradeCurrency::find($key->trade_currency_id);
                if (!empty($trade_currency) && $trade_currency->active == 1) {
                    if ($trade_currency->network == "bitcoin") {
                        $block_io = new \BlockIo($trade_currency->api_key, $trade_currency->secret_key, 2);
                        $recorded_transactions = [];
                        foreach (Deposit::where('network', 'bitcoin')->where('user_id',
                            $key->user_id)->get() as $tkey) {
                            array_push($recorded_transactions, $tkey->transaction_id);
                        }
                        $transactions = $block_io->get_transactions(array(
                            'type' => 'received',
                            'addresses' => $key->address
                        ));

                        if ($transactions->status == "success") {
                            foreach ($transactions->data->txs as $tkey) {

                                if (!in_array($tkey->txid, $recorded_transactions)) {
                                    //save the user record and update balance if confirmations are 3
                                    if ($tkey->confirmations >= $trade_currency->confirmations) {
                                        //we can save this one
                                        $deposit = new Deposit();
                                        $deposit->user_id = $key->user_id;
                                        $amount = 0;
                                        $recipient = "";
                                        foreach ($tkey->amounts_received as $amount_received) {
                                            $amount = $amount + $amount_received->amount;
                                            $recipient = $amount_received->recipient;
                                        }
                                        $deposit->amount = $amount;
                                        $deposit->trade_currency_id = $trade_currency->id;
                                        $deposit->transaction_id = $tkey->txid;
                                        $deposit->confirmations = $tkey->confirmations;
                                        $deposit->sender_address = $tkey->senders[0];
                                        $deposit->receiver_address = $recipient;
                                        //$deposit->deposit_method_id = 1;
                                        $deposit->network = "bitcoin";
                                        $deposit->status = "done";
                                        $deposit->save();
                                    }
                                }
                            }
                        }

                    }
                    if ($trade_currency->network == "litecoin") {
                        $block_io = new \BlockIo($trade_currency->api_key, $trade_currency->secret_key, 2);
                        $recorded_transactions = [];
                        foreach (Deposit::where('network', 'litecoin')->where('user_id',
                            $key->user_id)->get() as $tkey) {
                            array_push($recorded_transactions, $tkey->transaction_id);
                        }
                        $transactions = $block_io->get_transactions(array(
                            'type' => 'received',
                            'addresses' => $key->address
                        ));
                        if ($transactions->status == "success") {
                            foreach ($transactions->data->txs as $tkey) {
                                if (!in_array($tkey->txid, $recorded_transactions)) {
                                    //save the user record and update balance if confirmations are 3
                                    if ($tkey->confirmations >= $trade_currency->confirmations) {
                                        //we can save this one
                                        $deposit = new Deposit();
                                        $deposit->user_id = $key->user_id;
                                        $amount = 0;
                                        $recipient = "";
                                        foreach ($tkey->amounts_received as $amount_received) {
                                            $amount = $amount + $amount_received->amount;
                                            $recipient = $amount_received->recipient;
                                        }
                                        $deposit->amount = $amount;
                                        $deposit->trade_currency_id = $trade_currency->id;
                                        $deposit->transaction_id = $tkey->txid;
                                        $deposit->confirmations = $tkey->confirmations;
                                        $deposit->sender_address = $tkey->senders[0];
                                        $deposit->receiver_address = $recipient;
                                        //$deposit->deposit_method_id = 1;
                                        $deposit->network = "litecoin";
                                        $deposit->status = "done";
                                        $deposit->save();
                                    }
                                }
                            }
                        }

                    }
                    if ($trade_currency->network == "dogecoin") {
                        $block_io = new \BlockIo($trade_currency->api_key, $trade_currency->secret_key, 2);
                        $recorded_transactions = [];
                        foreach (Deposit::where('network', 'dogecoin')->where('user_id',
                            $key->user_id)->get() as $tkey) {
                            array_push($recorded_transactions, $tkey->transaction_id);
                        }
                        $transactions = $block_io->get_transactions(array(
                            'type' => 'received',
                            'addresses' => $key->address
                        ));
                        if ($transactions->status == "success") {
                            foreach ($transactions->data->txs as $tkey) {
                                if (!in_array($tkey->txid, $recorded_transactions)) {
                                    //save the user record and update balance if confirmations are 3
                                    if ($tkey->confirmations >= $trade_currency->confirmations) {
                                        //we can save this one
                                        $deposit = new Deposit();
                                        $deposit->user_id = $key->user_id;
                                        $amount = 0;
                                        $recipient = "";
                                        foreach ($tkey->amounts_received as $amount_received) {
                                            $amount = $amount + $amount_received->amount;
                                            $recipient = $amount_received->recipient;
                                        }
                                        $deposit->amount = $amount;
                                        $deposit->trade_currency_id = $trade_currency->id;
                                        $deposit->transaction_id = $tkey->txid;
                                        $deposit->confirmations = $tkey->confirmations;
                                        $deposit->sender_address = $tkey->senders[0];
                                        $deposit->receiver_address = $recipient;
                                        //$deposit->deposit_method_id = 1;
                                        $deposit->network = "dogecoin";
                                        $deposit->status = "done";
                                        $deposit->save();
                                    }
                                }
                            }
                        }

                    }

                    if ($trade_currency->network == "ethereum") {

                        $recorded_transactions = [];
                        foreach (Deposit::where('network', 'ethereum')->where('user_id',
                            $key->user_id)->get() as $tkey) {
                            array_push($recorded_transactions, $tkey->transaction_id);
                        }
                        //loop through user addresses

                        $res = $client->request('GET',
                            'https://api.ethplorer.io/getAddressTransactions/' . $key->address . '?apiKey=freekey');
                        if ($res->getStatusCode() == "200") {
                            foreach (json_decode($res->getBody()) as $tkey) {
                                if (!in_array($tkey->hash,
                                        $recorded_transactions) && $tkey->success == true && strcasecmp($tkey->to,
                                        $key->address) == 0
                                ) {

                                    $deposit = new Deposit();
                                    $deposit->user_id = $key->user_id;
                                    $deposit->amount = $tkey->value;
                                    $deposit->trade_currency_id = $trade_currency->id;
                                    $deposit->transaction_id = $tkey->hash;
                                    $deposit->sender_address = $tkey->from;
                                    $deposit->receiver_address = $tkey->to;
                                    //$deposit->deposit_method_id = 1;
                                    $deposit->network = "ethereum";
                                    $deposit->status = "done";
                                    $deposit->save();
                                }
                            }
                        }
                    }
                    if ($trade_currency->network == "ripple") {
                        $recorded_transactions = [];
                        foreach (Deposit::where('network', 'ripple')->where('user_id',
                            $key->user_id)->get() as $tkey) {
                            array_push($recorded_transactions, $tkey->transaction_id);
                        }
                        //loop through user addresses
                        $res = $client->request('GET',
                            'https://data.ripple.com/v2/accounts/' . $key->address . '/payments?type=received&limit=40');
                        if ($res->getStatusCode() == "200") {
                            foreach (json_decode($res->getBody())->payments as $tkey) {
                                if (!in_array($tkey->tx_hash,
                                        $recorded_transactions) && !empty($tkey->ledger_index)
                                ) {
                                    $deposit = new Deposit();
                                    $deposit->user_id = $key->user_id;
                                    $deposit->amount = $tkey->delivered_amount;
                                    $deposit->trade_currency_id = $trade_currency->id;
                                    $deposit->transaction_id = $tkey->tx_hash;
                                    $deposit->sender_address = $tkey->source;
                                    $deposit->receiver_address = $tkey->destination;
                                    //$deposit->deposit_method_id = 1;
                                    $deposit->network = "ripple";
                                    $deposit->status = "done";
                                    $deposit->save();
                                }
                            }
                        }
                    }
                }
            }
            Setting::where('setting_key',
                'cron_last_run')->update(['setting_value' => date("Y-m-d H:i:s")]);
            echo "Cron job run successfully";
        }
    }

}
