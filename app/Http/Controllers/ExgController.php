<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\User;
use App\Models\Exchange;
use App\Models\WalletAddress;
use App\cexapi;
use App\Models\TradeCurrency;
use App\Models\Setting;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;



class ExgController extends Controller
{

    public function test()
    {

        $api = new cexapi("up120427132", "0eScDx82HscbmrLsFSkR0ApohE", "eelpbJpf9rVwNkC3SwcBwoojNhk");
        echo "Ticker:<pre>", json_encode($api->ticker()), "</pre>";
        echo "Order Book:<pre>", json_encode($api->order_book()), "</pre>";
        echo "Balance:<pre>", json_encode($api->balance()), "</pre>";
        echo "Open Orders:<pre>", json_encode($api->open_orders()), "</pre>";
    }

    public function create_buy11111(Request $request)
    {

    	$coin_name = $request->coin_name; // From Ajax Requested
    	$symbol = strtoupper($coin_name).'AED';
    	$amount = $request->coin_amount;
    	$price = $request->usd_amount;
    	$exchange = 'bitfinex';
    	$side = $request->type;
    	$type = $request->order_type;
    	$buy_fees = $request->buy_fees;
    	$sell_fees = $request->sell_fees;
        $final_aed = $request->final_aed;

    	//echo $coin_name.$symbol.$amount.$price.$exchange.$side.$type;die;

    	 //Call API Bitfinex
    	$api_key = 'xxxxxxxxxx';
	    $api_secret = 'yyyyyyyyyy';

	   	//  $bfx = new Bitfinex($api_key, $api_secret);
        //	$result = $bfx->new_order($symbol,$amount,$price,$exchange,$side,$type,$is_hidden = FALSE, $is_postonly = FALSE,$ocoorder = FALSE,$buy_price_oco = NULL);
	 
        // print_r(json_decode($result1));die;

        if($result)
        {
        	    $exg = new Exchange;
		        $exg->user_id = Sentinel::getUser()->id;
		        $exg->order_id = $result->order_id;
		        $exg->symbol = $result->symbol;
		        $exg->exchange = $result->exchange;
		        $exg->price = $result->price;
		        $exg->avg_execution_price = $result->avg_execution_price;
		        $exg->side = $result->side;
		        $exg->type = $result->type;
		        $exg->timestamp = $result->timestamp;
		        $exg->is_live = $result->is_live;
		        $exg->is_cancelled = $result->is_cancelled;
		        $exg->is_hidden = $result->is_hidden;
		        $exg->was_forced = $result->was_forced;
		        $exg->original_amount = $result->original_amount;
		        $exg->remaining_amount = $result->remaining_amount;
		        $exg->executed_amount = $result->executed_amount;
                //Fees Data Add
                $exg->buy_fees = $buy_fees;
                $exg->sell_fees = $sell_fees;
                $exg->coin = $coin_name;
                $exg->final_aed = $final_aed;
		        $exg->save();

                $final_data = Exchange::where('id',$exg->id)->first();
                // if($side == 'buy')
                // {
                //     $less_amount = $final_data->final_aed;
                //     $coin_amount = $final_data->original_amount;
                //     $buy_fees = $final_data->buy_fees;
                //     $buser_id = $final_data->user_id;

                //     $less_amount = $less_amount + $buy_fees;
                //     $coin = strtoupper($final_data->coin);

                //     //update User's AED Balance
                //     $waddress = WalletAddress::where(array('user_id'=>$buser_id,'coin','AED'))->first();
                //     $waddress->balance = $waddress->balance - $less_amount;
                //     $waddress->save();

                //     //update User's Balance
                //     $waddress1 = WalletAddress::where(array('user_id'=>$buser_id,'coin',$coin))->first();
                //     $waddress->balance = $waddress->balance + $coin_amount;
                //     $waddress->save();

                //     // Give fees to Admin
                //     $waddress1 = WalletAddress::where(array('user_id'=>1,'coin','AED'))->first();
                //     $waddress->balance = $waddress->balance + $buy_fees;
                //     $waddress->save();

                // }
                // else if($side == 'sell')
                // {
                //     $add_amount = $final_data->final_aed;
                //     $coin_amount = $final_data->original_amount;
                //     $sell_fees = $final_data->sell_fees;
                //     $suser_id = $final_data->user_id;

                //     $add_amount = $add_amount - $sell_fees;
                //     $coin = strtoupper($final_data->coin);
                    
                //     //update User's AED Balance
                //     $waddress = WalletAddress::where(array('user_id'=>$suser_id,'coin','AED'))->first();
                //     $waddress->balance = $waddress->balance + $add_amount;
                //     $waddress->save();

                //     //update User's Balance
                //     $waddress1 = WalletAddress::where(array('user_id'=>$suser_id,'coin',$coin))->first();
                //     $waddress->balance = $waddress->balance - $coin_amount;
                //     $waddress->save();

                //     // Give fees to Admin
                //     $waddress1 = WalletAddress::where(array('user_id'=>1,'coin','AED'))->first();
                //     $waddress->balance = $waddress->balance + $sell_fees;
                //     $waddress->save();

                // }
                //else
               // {   }

             return 1;
        }
        else
        {
        	return 0;
        }

     

    }



    public function create_buy(Request $request)
    {
       
          $set_unm = Setting::where('setting_key','cex_username')->first();
          $username = $set_unm->setting_value;

          $set_api = Setting::where('setting_key','cex_api')->first();
          $api = $set_api->setting_value;

          $set_secret = Setting::where('setting_key','cex_secret')->first();
          $secret = $set_secret->setting_value;

          $aed_value = Setting::where('setting_key','aed_rate')->first();
          $aed_rate = $aed_value->setting_value;

        $coin_name = $request->coin_name; // From Ajax Requested
 //     $symbol = strtoupper($coin_name).'AED';
        $amount = $request->coin_amount;
        $price = $request->usd_amount/$aed_rate;
        $side = $request->type;
        $type = $request->order_type;
        $buy_fees = $request->buy_fees;
        $sell_fees = $request->sell_fees;
        $final_aed = $request->final_aed;

          $pass_type=strtolower($side);
          $pass_amount=$amount;
          $pass_price=$price/$aed_rate;
          $pass_couple=strtoupper($coin_name.'/'.'USD');

       $api = new cexapi($username,$api,$secret);
       $create_order =  $api->place_order($pass_type, $pass_amount, $pass_price, $pass_couple);

    }


}
