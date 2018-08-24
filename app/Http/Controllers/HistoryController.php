<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Deposit;

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

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['sentinel','verify_requirements']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $data = OrderBook::where('user_id', Sentinel::getUser()->id)->get();

        return view('history.data', compact('data','usd','btc','ltc','dogecoin','xrp','eth'));
    }


}
