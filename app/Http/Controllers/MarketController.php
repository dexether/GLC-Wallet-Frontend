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
use App\Models\WalletAddress;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class MarketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['sentinel','verify_requirements']);
    }

    public function index(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        if ($request->market == "btcusd" || empty($request->market)) {
            $title = "BTC/USD";
            $trade_currency = $btc;
        }
        if ($request->market == "ltcusd") {
            $title = "LTC/USD";
            $trade_currency = $ltc;
        }
        if ($request->market == "dogecoinusd") {
            $title = "DOGECOIN/USD";
            $trade_currency = $dogecoin;
        }
        if ($request->market == "xrpusd") {
            $title = "XRP/USD";
            $trade_currency = $xrp;
        }
        if ($request->market == "ethusd") {
            $title = "ETH/USD";
            $trade_currency = $eth;
        }
        $pending_orders = OrderBook::where('user_id', Sentinel::getUser()->id)->where('status',
            'pending')->where('trade_currency_id', $trade_currency->id)->orderBy('created_at', 'desc')->get();

        $done_orders = OrderBook::where('user_id', Sentinel::getUser()->id)->where('status',
            'done')->where('trade_currency_id', $trade_currency->id)->orderBy('created_at', 'desc')->get();
        $buy_orders = OrderBook::where('order_type', 'bid')->where('status', 'pending')->where('trade_currency_id',
            $trade_currency->id)->orderBy('created_at', 'desc')->get();
        $sell_orders = OrderBook::where('order_type', 'ask')->where('status', 'pending')->where('trade_currency_id',
            $trade_currency->id)->orderBy('created_at', 'desc')->get();
        $current_trade = OrderBook::where('order_type', 'ask')->where('trade_currency_id',
            $trade_currency->id)->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_trade)) {
            $current_trade = $current_trade->amount;
        } else {
            $current_trade = 0;
        }
        $today = date("Y-m-d");
        $yesterday = date_format(date_sub(date_create($today),
            date_interval_create_from_date_string('1 days')),
            'Y-m-d');
        $today .= " 23:59";
        $yesterday .= " 00:00";
        $minimum_trade = OrderBook::where('order_type', 'ask')->where('trade_currency_id',
            $trade_currency->id)->where('status', 'done')->whereBetween('created_at',
            [$yesterday, $today])->orderBy('amount',
            'asc')->first();
        if (!empty($minimum_trade)) {
            $minimum_trade = $minimum_trade->amount;
        } else {
            $minimum_trade = 0;
        }
        $maximum_trade = OrderBook::where('order_type', 'ask')->where('trade_currency_id',
            $trade_currency->id)->where('status', 'done')->whereBetween('created_at',
            [$yesterday, $today])->orderBy('amount',
            'desc')->first();
        if (!empty($maximum_trade)) {
            $maximum_trade = $maximum_trade->amount;
        } else {
            $maximum_trade = 0;
        }
        return view('market.data',
            compact('pending_orders', 'done_orders', 'usd', 'btc', 'dogecoin', 'ltc', 'current_trade', 'minimum_trade',
                'maximum_trade',
                'buy_orders', 'sell_orders', 'xrp', 'eth', 'title', 'trade_currency'));

    }

    public function buy(Request $request)
    {
        $trade_currency = TradeCurrency::find($request->trade_currency_id);
        $usd = TradeCurrency::where('default_currency', 1)->first();
        if (!empty($trade_currency)) {
            //check user balance here
            if ((GeneralHelper::user_currency_balance(Sentinel::getUser()->id,
                    $usd->id)) < ($request->buy_price * $request->buy_volume)
            ) {
                Flash::warning(trans('general.insufficient_balance'));
                return redirect()->back();
            }
            $order = new OrderBook();
            $order->trade_currency_id = $trade_currency->id;
            $order->user_id = Sentinel::getUser()->id;
            $order->order_type = "bid";
            $order->amount = $request->buy_price * $request->buy_volume;
            $order->price = $request->buy_price;
            $order->volume = $request->buy_volume;
            $order->status = "pending";
            $order->network = $trade_currency->network;
            $order->save();
            //try to match order
            if (OrderBook::where('status', 'pending')->where('trade_currency_id',
                    $trade_currency->id)->where('order_type',
                    'ask')->where('volume', $request->buy_volume)->where('user_id', '!=',
                    $order->user_id)->where('price',
                    $request->buy_price)->count() > 0
            ) {
                //we have a match
                $sell = OrderBook::find(OrderBook::where('status', 'pending')->where('trade_currency_id',
                    $trade_currency->id)->where('order_type',
                    'ask')->where('volume', $request->buy_volume)->where('price',
                    $request->buy_price)->where('user_id', '!=', $order->user_id)->orderBy('created_at',
                    'asc')->first()->id);
                $sell->linked_order_id = $order->id;
                $sell->status = "done";
                $sell->save();
                $buy = OrderBook::find($order->id);
                $buy->status = "done";
                $buy->linked_order_id = $sell->id;
                $buy->save();

                Flash::success(trans('general.order_successfully_placed_and_completed'));
                return redirect()->back();
            }
        } else {
            Flash::warning(trans('general.currency_not_found'));
            return redirect()->back();
        }


        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function sell(Request $request)
    {
        $trade_currency = TradeCurrency::find($request->trade_currency_id);
        $usd = TradeCurrency::where('default_currency', 1)->first();
        if (!empty($trade_currency)) {
            //check user balance here

            if ((GeneralHelper::user_currency_balance(Sentinel::getUser()->id,
                    $trade_currency->id)) < $request->sell_volume
            ) {
                Flash::warning(trans('general.insufficient_balance'));
                return redirect()->back();
            }
            $order = new OrderBook();
            $order->trade_currency_id = $trade_currency->id;
            $order->user_id = Sentinel::getUser()->id;
            $order->order_type = "ask";
            $order->amount = $request->sell_price * $request->sell_volume;
            $order->price = $request->sell_price;
            $order->volume = $request->sell_volume;
            $order->status = "pending";
            $order->network = $trade_currency->network;
            $order->save();
            //try to match order
            if (OrderBook::where('status', 'pending')->where('trade_currency_id',
                    $trade_currency->id)->where('order_type',
                    'bid')->where('volume', $request->sell_volume)->where('user_id', '!=',
                    $order->user_id)->where('price',
                    $request->sell_price)->count() > 0
            ) {
                //we have a match
                $buy = OrderBook::find(OrderBook::where('status', 'pending')->where('trade_currency_id',
                    $trade_currency->id)->where('order_type',
                    'bid')->where('volume', $request->sell_volume)->where('price',
                    $request->sell_price)->where('user_id', '!=', $order->user_id)->orderBy('created_at',
                    'asc')->first()->id);
                $buy->linked_order_id = $order->id;
                $buy->status = "done";
                $buy->save();
                $sell = OrderBook::find($order->id);
                $sell->status = "done";
                $sell->linked_order_id = $sell->id;
                $sell->save();

                Flash::success(trans('general.order_successfully_placed_and_completed'));
                return redirect()->back();
            }
        } else {
            Flash::warning(trans('general.currency_not_found'));
            return redirect()->back();
        }

        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function btcusd()
    {

        $pending_orders = OrderBook::where('user_id', Sentinel::getUser()->id)->where('status',
            'pending')->where('network', 'bitcoin')->orderBy('created_at', 'desc')->get();
        $buy_orders = OrderBook::where('order_type', 'bid')->where('status', 'pending')->where('network',
            'bitcoin')->orderBy('created_at', 'desc')->get();
        $sell_orders = OrderBook::where('order_type', 'ask')->where('status', 'pending')->where('network',
            'bitcoin')->orderBy('created_at', 'desc')->get();
        $usd = TradeCurrency::where('default_currency', 1)->first();
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
        $today = date("Y-m-d");
        $yesterday = date_format(date_sub(date_create($today),
            date_interval_create_from_date_string('1 days')),
            'Y-m-d');
        $today .= " 23:59";
        $yesterday .= " 00:00";
        $minimum_btc = OrderBook::where('order_type', 'ask')->where('network',
            'bitcoin')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'asc')->first();
        if (!empty($minimum_btc)) {
            $minimum_btc = $minimum_btc->amount;
        } else {
            $minimum_btc = 0;
        }
        $maximum_btc = OrderBook::where('order_type', 'ask')->where('network',
            'bitcoin')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'desc')->first();
        if (!empty($maximum_btc)) {
            $maximum_btc = $maximum_btc->amount;
        } else {
            $maximum_btc = 0;
        }
        return view('market.data',
            compact('pending_orders', 'usd', 'btc', 'dogecoin', 'ltc', 'current_ltc', 'minimum_ltc', 'maximum_ltc',
                'buy_orders', 'sell_orders', 'xrp', 'eth', 'title'));
    }

    public function buy_btc(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();

        //check user balance here
        if ((GeneralHelper::user_usd_balance(Sentinel::getUser()->id) - GeneralHelper::user_usd_locked_balance(Sentinel::getUser()->id)) < ($request->buy_price * $request->buy_volume)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $order = new OrderBook();
        $order->trade_currency_id = $btc->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "bid";
        $order->amount = $request->buy_price * $request->buy_volume;
        $order->price = $request->buy_price;
        $order->volume = $request->buy_volume;
        $order->status = "pending";
        $order->network = "bitcoin";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'bitcoin')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->buy_price)->count() > 0
        ) {
            //we have a match
            $sell = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'bitcoin')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('amount',
                $request->buy_price)->where('user_id', '!=', $order->user_id)->orderBy('created_at',
                'asc')->first()->id);
            $sell->linked_order_id = $order->id;
            $sell->status = "done";
            $sell->save();
            $buy = OrderBook::find($order->id);
            $buy->status = "done";
            $buy->linked_order_id = $sell->id;
            $buy->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function sell_btc(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        //check user balance here
        if ((GeneralHelper::user_btc_balance(Sentinel::getUser()->id) - GeneralHelper::user_btc_locked_balance(Sentinel::getUser()->id)) < $request->sell_volume) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $order = new OrderBook();
        $order->trade_currency_id = $btc->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "ask";
        $order->amount = $request->sell_price * $request->sell_volume;
        $order->price = $request->sell_price;
        $order->volume = $request->sell_volume;
        $order->status = "pending";
        $order->network = "bitcoin";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'bitcoin')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->sell_price)->count() > 0
        ) {
            //we have a match
            $buy = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'bitcoin')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('amount',
                $request->sell_price)->where('user_id', '!=', $order->user_id)->orderBy('created_at',
                'asc')->first()->id);
            $buy->linked_order_id = $order->id;
            $buy->status = "done";
            $buy->save();
            $sell = OrderBook::find($order->id);
            $sell->status = "done";
            $sell->linked_order_id = $sell->id;
            $sell->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function ltcusd()
    {

        $pending_orders = OrderBook::where('user_id', Sentinel::getUser()->id)->where('status',
            'pending')->where('network', 'litecoin')->orderBy('created_at', 'desc')->get();
        $buy_orders = OrderBook::where('order_type', 'bid')->where('status', 'pending')->where('network',
            'litecoin')->orderBy('created_at', 'desc')->get();
        $sell_orders = OrderBook::where('order_type', 'ask')->where('status', 'pending')->where('network',
            'litecoin')->orderBy('created_at', 'desc')->get();
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $current_ltc = OrderBook::where('order_type', 'ask')->where('network',
            'litecoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_ltc)) {
            $current_ltc = $current_ltc->amount;
        } else {
            $current_ltc = 0;
        }
        $today = date("Y-m-d");
        $yesterday = date_format(date_sub(date_create($today),
            date_interval_create_from_date_string('1 days')),
            'Y-m-d');
        $today .= " 23:59";
        $yesterday .= " 00:00";
        $minimum_ltc = OrderBook::where('order_type', 'ask')->where('network',
            'litecoin')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'asc')->first();
        if (!empty($minimum_ltc)) {
            $minimum_ltc = $minimum_ltc->amount;
        } else {
            $minimum_ltc = 0;
        }
        $maximum_ltc = OrderBook::where('order_type', 'ask')->where('network',
            'litecoin')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'desc')->first();
        if (!empty($maximum_ltc)) {
            $maximum_ltc = $maximum_ltc->amount;
        } else {
            $maximum_ltc = 0;
        }
        return view('market.ltcusd',
            compact('pending_orders', 'usd', 'btc', 'dogecoin', 'ltc', 'current_ltc', 'minimum_ltc', 'maximum_ltc',
                'buy_orders', 'sell_orders'));
    }

    public function buy_ltc(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();

        //check user balance here
        if ((GeneralHelper::user_usd_balance(Sentinel::getUser()->id) - GeneralHelper::user_usd_locked_balance(Sentinel::getUser()->id)) < ($request->buy_price * $request->buy_volume)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $order = new OrderBook();
        $order->trade_currency_id = $ltc->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "bid";
        $order->amount = $request->buy_price * $request->buy_volume;
        $order->price = $request->buy_price;
        $order->volume = $request->buy_volume;
        $order->status = "pending";
        $order->network = "litecoin";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'litecoin')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->buy_price)->count() > 0
        ) {
            //we have a match
            $sell = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'litecoin')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->buy_price)->orderBy('created_at', 'asc')->first()->id);
            $sell->linked_order_id = $order->id;
            $sell->status = "done";
            $sell->save();
            $buy = OrderBook::find($order->id);
            $buy->status = "done";
            $buy->linked_order_id = $sell->id;
            $buy->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function sell_ltc(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();

        //check user balance here
        if ((GeneralHelper::user_ltc_balance(Sentinel::getUser()->id) - GeneralHelper::user_ltc_locked_balance(Sentinel::getUser()->id)) < $request->sell_volume) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $order = new OrderBook();
        $order->trade_currency_id = $ltc->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "ask";
        $order->amount = $request->sell_price * $request->sell_volume;
        $order->price = $request->sell_price;
        $order->volume = $request->sell_volume;
        $order->status = "pending";
        $order->network = "litecoin";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'litecoin')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->sell_price)->count() > 0
        ) {
            //we have a match
            $buy = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'litecoin')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->sell_price)->orderBy('created_at', 'asc')->first()->id);
            $buy->linked_order_id = $order->id;
            $buy->status = "done";
            $buy->save();
            $sell = OrderBook::find($order->id);
            $sell->status = "done";
            $sell->linked_order_id = $sell->id;
            $sell->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function dogecoinusd()
    {

        $pending_orders = OrderBook::where('user_id', Sentinel::getUser()->id)->where('status',
            'pending')->where('network', 'dogecoin')->orderBy('created_at', 'desc')->get();
        $buy_orders = OrderBook::where('order_type', 'bid')->where('status', 'pending')->where('network',
            'dogecoin')->orderBy('created_at', 'desc')->get();
        $sell_orders = OrderBook::where('order_type', 'ask')->where('status', 'pending')->where('network',
            'dogecoin')->orderBy('created_at', 'desc')->get();
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $current_dogecoin = OrderBook::where('order_type', 'ask')->where('network',
            'dogecoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_dogecoin)) {
            $current_dogecoin = $current_dogecoin->amount;
        } else {
            $current_dogecoin = 0;
        }
        $today = date("Y-m-d");
        $yesterday = date_format(date_sub(date_create($today),
            date_interval_create_from_date_string('1 days')),
            'Y-m-d');
        $today .= " 23:59";
        $yesterday .= " 00:00";
        $minimum_dogecoin = OrderBook::where('order_type', 'ask')->where('network',
            'dogecoin')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'asc')->first();
        if (!empty($minimum_dogecoin)) {
            $minimum_dogecoin = $minimum_dogecoin->amount;
        } else {
            $minimum_dogecoin = 0;
        }
        $maximum_dogecoin = OrderBook::where('order_type', 'ask')->where('network',
            'dogecoin')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'desc')->first();
        if (!empty($maximum_dogecoin)) {
            $maximum_dogecoin = $maximum_dogecoin->amount;
        } else {
            $maximum_dogecoin = 0;
        }
        return view('market.dogecoinusd',
            compact('pending_orders', 'usd', 'btc', 'dogecoin', 'ltc', 'current_dogecoin', 'minimum_dogecoin',
                'maximum_dogecoin',
                'buy_orders', 'sell_orders'));
    }

    public function buy_dogecoin(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();

        //check user balance here
        if ((GeneralHelper::user_usd_balance(Sentinel::getUser()->id) - GeneralHelper::user_usd_locked_balance(Sentinel::getUser()->id)) < ($request->buy_price * $request->buy_volume)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $order = new OrderBook();
        $order->trade_currency_id = $dogecoin->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "bid";
        $order->amount = $request->buy_price * $request->buy_volume;
        $order->price = $request->buy_price;
        $order->volume = $request->buy_volume;
        $order->status = "pending";
        $order->network = "dogecoin";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'dogecoin')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->buy_price)->count() > 0
        ) {
            //we have a match
            $sell = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'dogecoin')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->buy_price)->orderBy('created_at', 'asc')->first()->id);
            $sell->linked_order_id = $order->id;
            $sell->status = "done";
            $sell->save();
            $buy = OrderBook::find($order->id);
            $buy->status = "done";
            $buy->linked_order_id = $sell->id;
            $buy->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function sell_dogecoin(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        if ((GeneralHelper::user_dogecoin_balance(Sentinel::getUser()->id) - GeneralHelper::user_dogecoin_locked_balance(Sentinel::getUser()->id)) < $request->sell_volume) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        //check user balance here
        $order = new OrderBook();
        $order->trade_currency_id = $dogecoin->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "ask";
        $order->amount = $request->sell_price * $request->sell_volume;
        $order->price = $request->sell_price;
        $order->volume = $request->sell_volume;
        $order->status = "pending";
        $order->network = "dogecoin";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'dogecoin')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->sell_price)->count() > 0
        ) {
            //we have a match
            $buy = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'dogecoin')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->sell_price)->orderBy('created_at', 'asc')->first()->id);
            $buy->linked_order_id = $order->id;
            $buy->status = "done";
            $buy->save();
            $sell = OrderBook::find($order->id);
            $sell->status = "done";
            $sell->linked_order_id = $sell->id;
            $sell->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function ethusd()
    {

        $pending_orders = OrderBook::where('user_id', Sentinel::getUser()->id)->where('status',
            'pending')->where('network', 'ethereum')->orderBy('created_at', 'desc')->get();
        $buy_orders = OrderBook::where('order_type', 'bid')->where('status', 'pending')->where('network',
            'ethereum')->orderBy('created_at', 'desc')->get();
        $sell_orders = OrderBook::where('order_type', 'ask')->where('status', 'pending')->where('network',
            'ethereum')->orderBy('created_at', 'desc')->get();
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $current_eth = OrderBook::where('order_type', 'ask')->where('network',
            'ethereum')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_eth)) {
            $current_eth = $current_eth->amount;
        } else {
            $current_eth = 0;
        }
        $today = date("Y-m-d");
        $yesterday = date_format(date_sub(date_create($today),
            date_interval_create_from_date_string('1 days')),
            'Y-m-d');
        $today .= " 23:59";
        $yesterday .= " 00:00";
        $minimum_eth = OrderBook::where('order_type', 'ask')->where('network',
            'ethereum')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'asc')->first();
        if (!empty($minimum_eth)) {
            $minimum_eth = $minimum_eth->amount;
        } else {
            $minimum_eth = 0;
        }
        $maximum_eth = OrderBook::where('order_type', 'ask')->where('network',
            'ethereum')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'desc')->first();
        if (!empty($maximum_eth)) {
            $maximum_eth = $maximum_eth->amount;
        } else {
            $maximum_eth = 0;
        }
        return view('market.ethusd',
            compact('pending_orders', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'current_eth', 'minimum_eth',
                'maximum_eth',
                'buy_orders', 'sell_orders'));
    }

    public function buy_eth(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        //check user balance here
        if ((GeneralHelper::user_usd_balance(Sentinel::getUser()->id) - GeneralHelper::user_usd_locked_balance(Sentinel::getUser()->id)) < ($request->buy_price * $request->buy_volume)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $order = new OrderBook();
        $order->trade_currency_id = $eth->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "bid";
        $order->amount = $request->buy_price * $request->buy_volume;
        $order->price = $request->buy_price;
        $order->volume = $request->buy_volume;
        $order->status = "pending";
        $order->network = "ethereum";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'ethereum')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->buy_price)->count() > 0
        ) {
            //we have a match
            $sell = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'ethereum')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->buy_price)->orderBy('created_at', 'asc')->first()->id);
            $sell->linked_order_id = $order->id;
            $sell->status = "done";
            $sell->save();
            $buy = OrderBook::find($order->id);
            $buy->status = "done";
            $buy->linked_order_id = $sell->id;
            $buy->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function sell_eth(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        //check user balance here
        if ((GeneralHelper::user_eth_balance(Sentinel::getUser()->id) - GeneralHelper::user_eth_locked_balance(Sentinel::getUser()->id)) < $request->sell_volume) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $order = new OrderBook();
        $order->trade_currency_id = $eth->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "ask";
        $order->amount = $request->sell_price * $request->sell_volume;
        $order->price = $request->sell_price;
        $order->volume = $request->sell_volume;
        $order->status = "pending";
        $order->network = "ethereum";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'ethereum')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->sell_price)->count() > 0
        ) {
            //we have a match
            $buy = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'ethereum')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->sell_price)->orderBy('created_at', 'asc')->first()->id);
            $buy->linked_order_id = $order->id;
            $buy->status = "done";
            $buy->save();
            $sell = OrderBook::find($order->id);
            $sell->status = "done";
            $sell->linked_order_id = $sell->id;
            $sell->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function xrpusd()
    {

        $pending_orders = OrderBook::where('user_id', Sentinel::getUser()->id)->where('status',
            'pending')->where('network', 'ripple')->orderBy('created_at', 'desc')->get();
        $buy_orders = OrderBook::where('order_type', 'bid')->where('status', 'pending')->where('network',
            'ripple')->orderBy('created_at', 'desc')->get();
        $sell_orders = OrderBook::where('order_type', 'ask')->where('status', 'pending')->where('network',
            'ripple')->orderBy('created_at', 'desc')->get();
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        $current_xrp = OrderBook::where('order_type', 'ask')->where('network',
            'ripple')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_xrp)) {
            $current_xrp = $current_xrp->amount;
        } else {
            $current_xrp = 0;
        }
        $today = date("Y-m-d");
        $yesterday = date_format(date_sub(date_create($today),
            date_interval_create_from_date_string('1 days')),
            'Y-m-d');
        $today .= " 23:59";
        $yesterday .= " 00:00";
        $minimum_xrp = OrderBook::where('order_type', 'ask')->where('network',
            'ripple')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'asc')->first();
        if (!empty($minimum_xrp)) {
            $minimum_xrp = $minimum_xrp->amount;
        } else {
            $minimum_xrp = 0;
        }
        $maximum_xrp = OrderBook::where('order_type', 'ask')->where('network',
            'ripple')->where('status', 'done')->whereBetween('created_at', [$yesterday, $today])->orderBy('amount',
            'desc')->first();
        if (!empty($maximum_xrp)) {
            $maximum_xrp = $maximum_xrp->amount;
        } else {
            $maximum_xrp = 0;
        }
        return view('market.ltcusd',
            compact('pending_orders', 'usd', 'btc', 'dogecoin', 'ltc', 'xrp', 'eth', 'current_xrp', 'minimum_xrp',
                'maximum_xrp',
                'buy_orders', 'sell_orders'));
    }

    public function buy_xrp(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        //check user balance here
        if ((GeneralHelper::user_usd_balance(Sentinel::getUser()->id) - GeneralHelper::user_usd_locked_balance(Sentinel::getUser()->id)) < ($request->buy_price * $request->buy_volume)) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $order = new OrderBook();
        $order->trade_currency_id = $xrp->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "bid";
        $order->amount = $request->buy_price * $request->buy_volume;
        $order->price = $request->buy_price;
        $order->volume = $request->buy_volume;
        $order->status = "pending";
        $order->network = "ripple";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'ripple')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->buy_price)->count() > 0
        ) {
            //we have a match
            $sell = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'ripple')->where('order_type',
                'ask')->where('volume', $request->buy_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->buy_price)->orderBy('created_at', 'asc')->first()->id);
            $sell->linked_order_id = $order->id;
            $sell->status = "done";
            $sell->save();
            $buy = OrderBook::find($order->id);
            $buy->status = "done";
            $buy->linked_order_id = $sell->id;
            $buy->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function sell_xrp(Request $request)
    {
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $btc = TradeCurrency::where('network', "bitcoin")->first();
        $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
        $ltc = TradeCurrency::where('network', "litecoin")->first();
        $xrp = TradeCurrency::where('network', "ripple")->first();
        $eth = TradeCurrency::where('network', "ethereum")->first();
        //check user balance here
        if ((GeneralHelper::user_xrp_balance(Sentinel::getUser()->id) - GeneralHelper::user_xrp_locked_balance(Sentinel::getUser()->id)) < $request->sell_volume) {
            Flash::warning(trans('general.insufficient_balance'));
            return redirect()->back();
        }
        $order = new OrderBook();
        $order->trade_currency_id = $ltc->id;
        $order->user_id = Sentinel::getUser()->id;
        $order->order_type = "ask";
        $order->amount = $request->sell_price * $request->sell_volume;
        $order->price = $request->sell_price;
        $order->volume = $request->sell_volume;
        $order->status = "pending";
        $order->network = "litecoin";
        $order->save();
        //try to match order
        if (OrderBook::where('status', 'pending')->where('network', 'ripple')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->sell_price)->count() > 0
        ) {
            //we have a match
            $buy = OrderBook::find(OrderBook::where('status', 'pending')->where('network',
                'ripple')->where('order_type',
                'bid')->where('volume', $request->sell_volume)->where('user_id', '!=', $order->user_id)->where('amount',
                $request->sell_price)->orderBy('created_at', 'asc')->first()->id);
            $buy->linked_order_id = $order->id;
            $buy->status = "done";
            $buy->save();
            $sell = OrderBook::find($order->id);
            $sell->status = "done";
            $sell->linked_order_id = $sell->id;
            $sell->save();

            Flash::success(trans('general.order_successfully_placed_and_completed'));
            return redirect()->back();
        }
        Flash::success(trans('general.order_successfully_placed'));
        return redirect()->back();
    }

    public function cancel_order($id)
    {
        $order = OrderBook::find($id);
        if ($order->user_id != Sentinel::getUser()->id || $order->status == "cancelled") {
            Flash::warning("Permission Denied");
            return redirect()->back();
        }
        $order->status = "cancelled";
        $order->save();
        Flash::success(trans('general.successfully_saved'));
        return redirect()->back();
    }

    public function refresh(Request $request)
    {
        $trade_currency = TradeCurrency::find($request->trade_currency_id);
        $usd = TradeCurrency::where('default_currency', 1)->first();
        if (!empty($trade_currency)) {
            $buy_orders = OrderBook::where('order_type', 'bid')->where('status', 'pending')->where('trade_currency_id',
                $trade_currency->id)->orderBy('created_at', 'desc')->get();
            $sell_orders = OrderBook::where('order_type', 'ask')->where('status', 'pending')->where('trade_currency_id',
                $trade_currency->id)->orderBy('created_at', 'desc')->get();

            return View::make('market.refresh', compact('buy_orders', 'sell_orders', 'trade_currency','usd'))->render();
        }

    }

    public function latest_price(Request $request)
    {
        $current_btc = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
            'bitcoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_btc)) {
            $current_btc = number_format($current_btc->amount, 2);
        } else {
            $current_btc = 0;
        }
        $current_dogecoin = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
            'dogecoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_dogecoin)) {
            $current_dogecoin = number_format($current_dogecoin->amount, 2);
        } else {
            $current_dogecoin = 0;
        }
        $current_ltc = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
            'litecoin')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_ltc)) {
            $current_ltc = number_format($current_ltc->amount, 2);
        } else {
            $current_ltc = 0;
        }
        $current_eth = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
            'ethereum')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_eth)) {
            $current_eth = number_format($current_eth->amount, 2);
        } else {
            $current_eth = 0;
        }
        $current_xrp = \App\Models\OrderBook::where('order_type', 'ask')->where('network',
            'ripple')->where('status', 'done')->orderBy('updated_at', 'desc')->first();
        if (!empty($current_xrp)) {
            $current_xrp = number_format($current_xrp->amount, 2);
        } else {
            $current_xrp = 0;
        }
        $json = [];
        $json["btcusd"] = $current_btc;
        $json["ltcusd"] = $current_ltc;
        $json["ethusd"] = $current_eth;
        $json["xrpusd"] = $current_xrp;
        $json["dogecoinusd"] = $current_dogecoin;
        return json_encode($json, JSON_UNESCAPED_SLASHES);
    }

    public function graph(Request $request)
    {
        $trade_currency = TradeCurrency::find($request->trade_currency_id);
        $usd = TradeCurrency::where('default_currency', 1)->first();
        $json = [];
        $open = 0;
        $close = 0;
        $high = 0;
        $low = 0;
        $volume = 0;
        if (!empty($trade_currency)) {
            $date = date("Y-m-d");
            $date = date_format(date_sub(date_create($date),
                date_interval_create_from_date_string('31 days')),
                'Y-m-d');
            for ($i = 0; $i < 32; $i++) {
                $open_bid = OrderBook::where('order_type', 'bid')->where('status', 'done')->where('trade_currency_id',
                    $trade_currency->id)->whereBetween('updated_at',
                    [$date . " 00:00:00", $date . " 23:59:59"])->orderBy('updated_at', 'asc')->first();
                if (!empty($open_bid)) {
                    $open = $open_bid->price;
                } else {
                    $open = 0;
                }
                $close_bid = OrderBook::where('order_type', 'bid')->where('status', 'done')->where('trade_currency_id',
                    $trade_currency->id)->whereBetween('updated_at',
                    [$date . " 00:00:00", $date . " 23:59:59"])->orderBy('updated_at', 'desc')->first();
                if (!empty($close_bid)) {
                    $close = $close_bid->price;
                } else {
                    $close = 0;
                }
                $low_bid = OrderBook::where('order_type', 'bid')->where('status', 'done')->where('trade_currency_id',
                    $trade_currency->id)->whereBetween('updated_at',
                    [$date . " 00:00:00", $date . " 23:59:59"])->orderBy('price',
                    'asc')->first();
                if (!empty($low_bid)) {
                    $low = $low_bid->price;
                } else {
                    $low = 0;
                }
                $high_bid = OrderBook::where('order_type', 'bid')->where('status', 'done')->where('trade_currency_id',
                    $trade_currency->id)->whereBetween('updated_at',
                    [$date . " 00:00:00", $date . " 23:59:59"])->orderBy('price',
                    'desc')->first();
                if (!empty($high_bid)) {
                    $high = $high_bid->price;
                } else {
                    $high = 0;
                }
                $volume = OrderBook::where('order_type', 'bid')->where('status', 'done')->where('trade_currency_id',
                    $trade_currency->id)->whereBetween('updated_at',
                    [$date . " 00:00:00", $date . " 23:59:59"])->sum('volume');
                if ($high >= 0) {
                    array_push($json, [
                        "date" => $date,
                        "open" => round($open, 2),
                        "close" => round($close, 2),
                        "high" => round($high, 2),
                        "low" => round($low, 2),
                        "volume" => round($volume, 2)

                    ]);
                }
                $date = date_format(date_add(date_create($date),
                    date_interval_create_from_date_string('1 days')),
                    'Y-m-d');
            }
        }
        return json_encode($json);
    }


}
