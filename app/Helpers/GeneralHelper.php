<?php

/**
 * Created by PhpStorm.
 * User: Tj
 * Date: 6/29/2016
 * Time: 3:11 PM
 */

namespace App\Helpers;

use App\Models\Deposit;
use App\Models\AssetValuation;
use App\Models\AuditTrail;
use App\Models\Capital;
use App\Models\Expense;
use App\Models\JournalEntry;
use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Models\LoanSchedule;
use App\Models\LoanTransaction;
use App\Models\OrderBook;
use App\Models\OtherIncome;
use App\Models\Payroll;
use App\Models\PayrollMeta;
use App\Models\Product;
use App\Models\ProductCheckin;
use App\Models\ProductCheckinItem;
use App\Models\ProductCheckout;
use App\Models\ProductCheckoutItem;
use App\Models\Saving;
use App\Models\SavingTransaction;
use App\Models\Setting;
use App\Models\SmsGateway;
use App\Models\TradeCurrency;
use App\Models\Withdrawal;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Str;

class GeneralHelper
{
    //get active theme
    public static function get_active_theme_directory($sep = '.')
    {
        return 'themes' . $sep . Setting::where('setting_key', 'active_theme')->first()->setting_value;
    }

    /*
     * determine interest
     */


    public static function time_ago($eventTime)
    {
        $totaldelay = time() - strtotime($eventTime);
        if ($totaldelay <= 0) {
            return '';
        } else {
            if ($days = floor($totaldelay / 86400)) {
                $totaldelay = $totaldelay % 86400;
                return $days . ' days ago';
            }
            if ($hours = floor($totaldelay / 3600)) {
                $totaldelay = $totaldelay % 3600;
                return $hours . ' hours ago';
            }
            if ($minutes = floor($totaldelay / 60)) {
                $totaldelay = $totaldelay % 60;
                return $minutes . ' minutes ago';
            }
            if ($seconds = floor($totaldelay / 1)) {
                $totaldelay = $totaldelay % 1;
                return $seconds . ' seconds ago';
            }
        }
    }


    public static function addMonths($date, $months)
    {
        $orig_day = $date->format("d");
        $date->modify("+" . $months . " months");
        while ($date->format("d") < $orig_day && $date->format("d") < 5) {
            $date->modify("-1 day");
        }
    }


    public static function audit_trail($notes)
    {
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = Sentinel::getUser()->id;
        $audit_trail->user = Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name;
        $audit_trail->notes = $notes;
        $audit_trail->save();

    }

    /*
     * Wallet balance is affected by deposits, withdrawals and orders.
     * A  pending order locks balance. A fulfilled order either decreases or increases balance
     */
    public static function user_usd_balance($id)
    {

        $balance = 0;
        $deposits = Deposit::where('user_id', $id)->where('status', 'done')->where('network', 'usd')->sum('amount');
        $withdrawals = Withdrawal::where('user_id', $id)->where('status', 'done')->where('network',
            'usd')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'bid')->sum('amount');
        $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'ask')->sum('amount');
        return $balance + ($deposits + $order_deposits - $withdrawals - $order_withdrawals);

    }

    public static function user_aed_balance($id)
    {

        $balance = 0;
        $deposits = Deposit::where('user_id', $id)->where('status', 'done')->where('network', 'aed')->sum('amount');
        $withdrawals = Withdrawal::where('user_id', $id)->where('status', 'done')->where('network',
            'usd')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'bid')->sum('amount');
        $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'ask')->sum('amount');
        return $balance + ($deposits + $order_deposits - $withdrawals - $order_withdrawals);

    }


    public static function user_usd_locked_balance($id)
    {

        $balance = 0;
        $withdrawals = Withdrawal::where('user_id', $id)->whereIn('status', ['pending', 'processing'])->where('network',
            'usd')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'pending')->where('order_type',
            'bid')->sum('amount');
        return $balance + ($withdrawals + $order_withdrawals);

    }

    public static function user_aed_locked_balance($id)
    {

    $balance = 0;
    $withdrawals = Withdrawal::where('user_id', $id)->whereIn('status', ['pending', 'processing'])->where('network',
        'aed')->sum('amount');
    $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'pending')->where('order_type',
        'bid')->sum('amount');
    return $balance + ($withdrawals + $order_withdrawals);

    }

    public static function user_btc_balance($id)
    {

        $balance = 0;
        $deposits = Deposit::where('user_id', $id)->where('status', 'done')->where('network', 'bitcoin')->sum('amount');
        $withdrawals = Withdrawal::where('user_id', $id)->where('status', 'done')->where('network',
            'bitcoin')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'bid')->where('network',
            'bitcoin')->sum('volume');
        $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'ask')->where('network',
            'bitcoin')->sum('volume');
        return $balance + ($deposits + $order_deposits - $withdrawals - $order_withdrawals);

    }

    public static function user_btc_locked_balance($id)
    {

        $balance = 0;
        $withdrawals = Withdrawal::where('user_id', $id)->whereIn('status', ['pending', 'processing'])->where('network',
            'bitcoin')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'pending')->where('order_type',
            'ask')->where('network',
            'bitcoin')->sum('volume');
        return $balance + ($withdrawals + $order_withdrawals);

    }

    public static function user_ltc_balance($id)
    {

        $balance = 0;
        $deposits = Deposit::where('user_id', $id)->where('status', 'done')->where('network',
            'litecoin')->sum('amount');
        $withdrawals = Withdrawal::where('user_id', $id)->where('status', 'done')->where('network',
            'litecoin')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'bid')->where('network',
            'litecoin')->sum('volume');
        $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'ask')->where('network',
            'litecoin')->sum('volume');
        return $balance + ($deposits + $order_deposits - $withdrawals - $order_withdrawals);

    }

    public static function user_ltc_locked_balance($id)
    {

        $balance = 0;
        $withdrawals = Withdrawal::where('user_id', $id)->whereIn('status', ['pending', 'processing'])->where('network',
            'litecoin')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'pending')->where('order_type',
            'ask')->where('network',
            'litecoin')->sum('volume');
        return $balance + ($withdrawals + $order_withdrawals);

    }

    public static function user_dogecoin_balance($id)
    {

        $balance = 0;
        $deposits = Deposit::where('user_id', $id)->where('status', 'done')->where('network',
            'dogecoin')->sum('amount');
        $withdrawals = Withdrawal::where('user_id', $id)->where('status', 'done')->where('network',
            'dogecoin')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'bid')->where('network',
            'dogecoin')->sum('volume');
        $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'ask')->where('network',
            'dogecoin')->sum('volume');
        return $balance + ($deposits + $order_deposits - $withdrawals - $order_withdrawals);

    }

    public static function user_dogecoin_locked_balance($id)
    {

        $balance = 0;
        $withdrawals = Withdrawal::where('user_id', $id)->whereIn('status', ['pending', 'processing'])->where('network',
            'dogecoin')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'pending')->where('order_type',
            'ask')->where('network',
            'dogecoin')->sum('volume');
        return $balance + ($withdrawals + $order_withdrawals);

    }

    public static function user_xrp_balance($id)
    {

        $balance = 0;
        $deposits = Deposit::where('user_id', $id)->where('status', 'done')->where('network',
            'ripple')->sum('amount');
        $withdrawals = Withdrawal::where('user_id', $id)->where('status', 'done')->where('network',
            'ripple')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'bid')->where('network',
            'ripple')->sum('volume');
        $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'ask')->where('network',
            'ripple')->sum('volume');
        return $balance + ($deposits + $order_deposits - $withdrawals - $order_withdrawals);

    }

    public static function user_xrp_locked_balance($id)
    {

        $balance = 0;
        $withdrawals = Withdrawal::where('user_id', $id)->whereIn('status', ['pending', 'processing'])->where('network',
            'ripple')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'pending')->where('order_type',
            'ask')->where('network',
            'ripple')->sum('volume');
        return $balance + ($withdrawals + $order_withdrawals);

    }

    public static function user_eth_balance($id)
    {

        $balance = 0;
        $deposits = Deposit::where('user_id', $id)->where('status', 'done')->where('network',
            'ethereum')->sum('amount');
        $withdrawals = Withdrawal::where('user_id', $id)->where('status', 'done')->where('network',
            'ethereum')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'bid')->where('network',
            'ethereum')->sum('volume');
        $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'ask')->where('network',
            'ethereum')->sum('volume');
        return $balance + ($deposits + $order_deposits - $withdrawals - $order_withdrawals);

    }

    public static function user_eth_locked_balance($id)
    {

        $balance = 0;
        $withdrawals = Withdrawal::where('user_id', $id)->whereIn('status', ['pending', 'processing'])->where('network',
            'ethereum')->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'pending')->where('order_type',
            'ask')->where('network',
            'ethereum')->sum('volume');
        return $balance + ($withdrawals + $order_withdrawals);

    }

    public static function total_usd_fees($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('network', 'usd')->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('network',
                'usd')->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('network',
                'usd')->sum('fee');
        } else {
            $deposits = Deposit::where('status', 'done')->where('network', 'usd')->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('network',
                'usd')->whereBetween('created_at', [$start_date, $end_date])->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('network',
                'usd')->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
        }
        return $balance + $deposits + $orders + $withdrawals;

    }

    public static function total_btc_fees($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('network', 'bitcoin')->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('network',
                'bitcoin')->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('network',
                'bitcoin')->sum('fee');
        } else {
            $deposits = Deposit::where('status', 'done')->where('network', 'bitcoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('network',
                'bitcoin')->whereBetween('created_at', [$start_date, $end_date])->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('network',
                'bitcoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
        }
        return $balance + $deposits + $orders + $withdrawals;

    }

    public static function total_ltc_fees($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('network', 'litecoin')->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('network',
                'litecoin')->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('network',
                'litecoin')->sum('fee');
        } else {
            $deposits = Deposit::where('status', 'done')->where('network', 'litecoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('network',
                'litecoin')->whereBetween('created_at', [$start_date, $end_date])->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('network',
                'litecoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
        }
        return $balance + $deposits + $orders + $withdrawals;

    }

    public static function total_dogecoin_fees($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('network', 'dogecoin')->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('network',
                'dogecoin')->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('network',
                'dogecoin')->sum('fee');
        } else {
            $deposits = Deposit::where('status', 'done')->where('network', 'dogecoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('network',
                'dogecoin')->whereBetween('created_at', [$start_date, $end_date])->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('network',
                'dogecoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
        }
        return $balance + $deposits + $orders + $withdrawals;

    }

    public static function total_usd_deposits($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('network', 'usd')->sum('amount');

        } else {
            $deposits = Deposit::where('status', 'done')->where('network', 'usd')->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');
        }
        return $balance + $deposits;

    }

    public static function total_btc_deposits($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('network', 'bitcoin')->sum('amount');
        } else {
            $deposits = Deposit::where('status', 'done')->where('network', 'bitcoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');

        }
        return $balance + $deposits;

    }

    public static function total_ltc_deposits($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('network', 'litecoin')->sum('amount');
        } else {
            $deposits = Deposit::where('status', 'done')->where('network', 'litecoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');

        }
        return $balance + $deposits;

    }

    public static function total_dogecoin_deposits($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('network', 'dogecoin')->sum('amount');
        } else {
            $deposits = Deposit::where('status', 'done')->where('network', 'dogecoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');
        }
        return $balance + $deposits;

    }

    public static function total_usd_withdrawals($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Withdrawal::where('status', 'done')->where('network', 'usd')->sum('amount');

        } else {
            $deposits = Withdrawal::where('status', 'done')->where('network', 'usd')->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');
        }
        return $balance + $deposits;

    }

    public static function total_btc_withdrwals($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Withdrawal::where('status', 'done')->where('network', 'bitcoin')->sum('amount');
        } else {
            $deposits = Withdrawal::where('status', 'done')->where('network', 'bitcoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');

        }
        return $balance + $deposits;

    }

    public static function total_ltc_withdrawals($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Withdrawal::where('status', 'done')->where('network', 'litecoin')->sum('amount');
        } else {
            $deposits = Withdrawal::where('status', 'done')->where('network', 'litecoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');

        }
        return $balance + $deposits;

    }

    public static function total_dogecoin_withdrawals($start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Withdrawal::where('status', 'done')->where('network', 'dogecoin')->sum('amount');
        } else {
            $deposits = Withdrawal::where('status', 'done')->where('network',
                'dogecoin')->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');
        }
        return $balance + $deposits;

    }

    public static function user_currency_balance($id, $currency)
    {
        $balance = 0;
        $actual = GeneralHelper::user_actual_balance($id, $currency);
        $locked = GeneralHelper::user_currency_locked_balance($id,
            $currency);
        $balance = $actual - $locked;
        return $balance;

    }

    public static function user_actual_balance($id, $currency)
    {
        $trade_currency = TradeCurrency::find($currency);
        $balance = 0;
        $deposits = Deposit::where('user_id', $id)->where('status', 'done')->where('trade_currency_id',
            $currency)->sum('amount');
        $withdrawals = Withdrawal::where('user_id', $id)->where('status', 'done')->where('trade_currency_id',
            $currency)->sum('amount');
        if ($trade_currency->default_currency == 1) {
            $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
                'bid')->sum('amount');
            $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
                'ask')->sum('amount');
        } else {
            $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
                'ask')->where('trade_currency_id', $currency)->sum('volume');
            $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
                'bid')->where('trade_currency_id', $currency)->sum('volume');
        }

        return $balance + ($deposits + $order_deposits - $withdrawals - $order_withdrawals);

    }

    public static function user_currency_locked_balance($id, $currency)
    {
        $balance = 0;
        $trade_currency = TradeCurrency::find($currency);
        if ($trade_currency->default_currency == 1) {
            $withdrawals = Withdrawal::where('user_id', $id)->whereIn('status',
                ['pending', 'processing'])->where('network',
                'usd')->sum('amount');
            $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'pending')->where('order_type',
                'bid')->sum('amount');
        } else {
            $withdrawals = Withdrawal::where('user_id', $id)->whereIn('status',
                ['pending', 'processing'])->where('trade_currency_id', $currency)->sum('amount');
            $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'pending')->where('order_type',
                'ask')->where('trade_currency_id', $currency)->sum('volume');
        }


        return $balance + ($withdrawals + $order_withdrawals);

    }

    public static function total_currency_fees($id, $start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('trade_currency_id', $id)->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('trade_currency_id', $id)->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('trade_currency_id', $id)->sum('fee');
        } else {
            $deposits = Deposit::where('status', 'done')->where('trade_currency_id', $id)->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
            $withdrawals = Withdrawal::where('status', 'done')->where('trade_currency_id',
                $id)->whereBetween('created_at', [$start_date, $end_date])->sum('fee');
            $orders = OrderBook::where('status', 'done')->where('trade_currency_id', $id)->whereBetween('created_at',
                [$start_date, $end_date])->sum('fee');
        }
        return $balance + $deposits + $orders + $withdrawals;

    }

    public static function total_currency_withdrawals($id, $start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Withdrawal::where('status', 'done')->where('trade_currency_id', $id)->sum('amount');
        } else {
            $deposits = Withdrawal::where('status', 'done')->where('trade_currency_id', $id)->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');
        }
        return $balance + $deposits;

    }

    public static function total_currency_deposits($id, $start_date = "", $end_date = "")
    {

        $balance = 0;
        if (empty($start_date)) {
            $deposits = Deposit::where('status', 'done')->where('trade_currency_id', $id)->sum('amount');
        } else {
            $deposits = Deposit::where('status', 'done')->where('trade_currency_id', $id)->whereBetween('created_at',
                [$start_date, $end_date])->sum('amount');

        }
        return $balance + $deposits;

    }

    public static function total_currency_balance($id)
    {

        $balance = 0;
        $deposits = Deposit::where('user_id', $id)->where('status', 'done')->where('trade_currency_id',
            $id)->sum('amount');
        $withdrawals = Withdrawal::where('user_id', $id)->where('status', 'done')->where('trade_currency_id',
            $id)->sum('amount');
        $order_withdrawals = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'bid')->where('trade_currency_id', $id)->sum('volume');
        $order_deposits = OrderBook::where('user_id', $id)->where('status', 'done')->where('order_type',
            'ask')->where('trade_currency_id', $id)->sum('volume');
        return $balance + ($deposits + $order_deposits - $withdrawals - $order_withdrawals);

    }

    public static function send_sms($to, $msg)
    {

//        http://api.smsala.com/api/SendSMS?api_id=API101980724322&api_password=123456789&sms_type=P&encoding=T&sender_id=smsala&phonenumber=8141964880&textmessage=test

        if (Setting::where('setting_key', 'sms_enabled')->first()->setting_value == 1) {
            if (!empty(SmsGateway::find(Setting::where('setting_key',
                'active_sms')->first()->setting_value))
            ) {
                $active_sms = SmsGateway::find(Setting::where('setting_key',
                    'active_sms')->first()->setting_value);
                $append = "&";
                $append .= $active_sms->to_name . "=" . $to;
                $append .= "&" . $active_sms->msg_name . "=" . $msg;
                $url = $active_sms->url . $append;
                $url = 'http://api.smsala.com/api/SendSMS?api_id=API101980724322&api_password=123456789&sms_type=P&encoding=T&sender_id=smsala&phonenumber='.$to.'&textmessage='.$msg;
                $url ="http://api.smsala.com/api/SendSMS?api_id=API101980724322&api_password=123456789&sms_type=P&encoding=T&sender_id=smsala&phonenumber=9687616362&textmessage=test";
                //send sms here
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_VERBOSE, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);
            }
        }

    }


}