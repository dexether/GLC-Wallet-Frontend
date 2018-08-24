<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;

use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\OrderBook;
use App\Models\Setting;
use App\Models\TradeCurrency;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class ApiController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function last_price()
    {
        $json = [];
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $current_btc = OrderBook::where('order_type', 'ask')->where('network',
            'bitcoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_btc)) {
            $current_btc = $current_btc->amount;
        } else {
            $current_btc = 0;
        }
        $current_dogecoin = OrderBook::where('order_type', 'ask')->where('network',
            'dogecoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_dogecoin)) {
            $current_dogecoin = $current_dogecoin->amount;
        } else {
            $current_dogecoin = 0;
        }
        $current_ltc = OrderBook::where('order_type', 'ask')->where('network',
            'litecoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_ltc)) {
            $current_ltc = $current_ltc->amount;
        } else {
            $current_ltc = 0;
        }
        $json["bitcoin"] = round($current_btc, 2);
        $json["litecoin"] = round($current_ltc, 2);
        $json["dogecoin"] = round($current_dogecoin, 2);
        return json_encode($json, JSON_UNESCAPED_SLASHES);
    }


}
