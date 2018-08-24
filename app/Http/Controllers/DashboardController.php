<?php

namespace App\Http\Controllers;
use App\Models\WalletAddress;
use App\Models\TradeCurrency;
use Illuminate\Http\Request;
use App\Models\Exchange;
use App\Models\Setting;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\cexapi;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['sentinel','verify_requirements']);
    }

    public function index($coinuse='BTC')
    {
        $marks = array('BTC', 'ETH', 'XRP','LTC');

        if (!in_array($coinuse, $marks))
            return redirect()->to("dashboard-exchange/BTC");


      $user_id = Sentinel::getUser()->id;
      $trade_cur = WalletAddress::where('user_id',$user_id)->get();

      $buy_fees = Setting::where('setting_key','buy_percentage')->first()->setting_value;
      $sell_fees =Setting::where('setting_key','sell_percentage')->first()->setting_value;
      $aed_rate =Setting::where('setting_key','aed_rate')->first()->setting_value;
      $exchange_data = Exchange::where('user_id',$user_id)->orderby('id','desc')->get();

    	return view('exchange.dashboard',compact('buy_fees','sell_fees','trade_cur','exchange_data','aed_rate',"coinuse"));
    }
}
