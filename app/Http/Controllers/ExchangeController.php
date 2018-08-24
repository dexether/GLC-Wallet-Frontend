<?php

namespace App\Http\Controllers;

use App\Bitstamp;
use App\Events\DepositReceived;
use App\Helpers\GeneralHelper;
use App\Models\Exchange;
use App\Models\Setting;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use App\cexapi;
use Illuminate\Support\Facades\Log;



class ExchangeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['sentinel','verify_requirements']);
    }

    public function buy()
    {

        if (!Sentinel::hasAccess('currencies.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        $buy_data = Exchange::where(array('side' =>'buy'))->orderBy('id', 'DESC')->get();
        return view('exchange.buy', compact('buy_data'));
    }
    public function sell()
    {
        if (!Sentinel::hasAccess('currencies.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $sell_data = Exchange::where(array('side' =>'sell'))->orderBy('id', 'DESC')->get();
        return view('exchange.sell', compact('sell_data'));
    }

    public function call_order_middle(Request $request)
    {

        $html="";
        $coin = strtoupper($request->option);
        $user_id = Sentinel::getUser()->id;
        if($coin == "ALL")
        $exgdata = Exchange::where(array('user_id'=>$user_id))->orderBy('same_price','DESC')->get();
        else
        $exgdata = Exchange::where(array('user_id'=>$user_id,'coin'=>$coin))->orderBy('same_price','DESC')->get();
        $index=1;

        if(sizeof($exgdata) >= 1)
        {
            foreach ($exgdata as $exg)
            {
                if($exg->status == 0 || $exg->status == 2)
                {
                    if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                    else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                    else{  }

                    $total = ($exg->price) * ($exg->same_price);
                    $html.="<tr id='order_cancal$exg->id' onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                                                        <td><b>".$index++."</b></td>
                                                                        <td><b>".$exg->side."</b></td>
                                                                        <td>".$exg->order_id."</td>
                                                                        <td>".$exg->coin."</td>
                                                                        <td>".number_format($exg->same_price, 2)."</td>
                                                                        <td>".number_format($exg->price, 2)."</td>
                                                                        <td>".number_format($exg->buy_fee, 2)."</td>
                                                                        <td>".number_format($exg->final_aed, 2)."</td>
                                                                        <td>";


                    $html.="<lable onclick='cancel_order_user(".$exg->id.",".$exg->order_id.")' class='btn btn-info'>cancel</lable>";


                    $html.= "</td><td>";

                    if($exg->status == 0)
                    {  $html.="<label class='label label-warning'>Pending</label>";  }
                    elseif($exg->status == 2)
                    {  $html.="<label class='label label-info'> Partially Pay</label>"; }
                    else
                    {    }
                    $html.="</td></tr>";
                }
                else
                {   }
            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }
        echo $html;die;
    }



    function call_order_full(Request $request)
    {
        $html="";
        $coin = strtoupper($request->option);
        $user_id = Sentinel::getUser()->id;

        if($request->option =="ALL")
           $exgdata = Exchange::where(array('user_id'=>$user_id))->orderBy('id','DESC')->get();
        else
            $exgdata = Exchange::where(array('user_id'=>$user_id,'coin'=>$coin))->orderBy('id','DESC')->get();

        $index =1;

        if(sizeof($exgdata) >= 1)
        {
            foreach ($exgdata as $exg)
            {
                if($exg->status == 1 || $exg->status == 3)
                {
                    if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                    else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                    else{  }

                    $total = ($exg->price) * ($exg->same_price);

                    $html.="<tr id='order_cancal$exg->id'  onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                                                             <td><b>".$index++."</b></td>
                                                                            <td><b>".$exg->side."</b></td>
                                                                            <td>".$exg->order_id."</td>
                                                                            <td>".$exg->coin."</td>
                                                                            <td>".number_format($exg->same_price, 2)."</td>
                                                                            <td>".number_format($exg->price, 2)."</td>
                                                                           <td>".number_format($exg->buy_fees, 2)."</td>
                                                                           <td>".number_format($exg->final_aed, 2)."</td>
                                                                           <td>";


                    if($exg->status == 1)
                    {  $html.="<label class='label label-success'>Success</label>";  }
                    elseif($exg->status == 3)
                    {  $html.="<label class='label label-danger'> Cancel </label>"; }
                    else
                    {    }
                    $html.="</td></tr>";
                }
                else
                {   }
            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }
        echo $html;die;
    }

    function order_full(Request $request)
    {
        $html="";
        $type = $request->option;
        $user_id = Sentinel::getUser()->id;


        if($type == 'bid')
        {

            $exgdata = Exchange::where(array('user_id'=>$user_id))->orderBy('id','DESC')->get();
        }
        elseif($type == 'ask')
        {

            $exgdata = Exchange::where(array('user_id'=>$user_id))->orderBy('id','ASC')->get();
        }
        else
        {    }

        if(sizeof($exgdata) >= 1)
        {
            $index = 1;
            foreach ($exgdata as $exg)
            {
                if($exg->status == 1 || $exg->status == 3)
                {
                    if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                    else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                    else{  }

                    $total = ($exg->price) * ($exg->same_price);

                    $html.="<tr id='order_cancal$exg->id' onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                                                                  <td><b>".$index."</b></td>
                                                                                  <td><b>".$exg->side."</b></td>
                                                                                  <td>".$exg->order_id."</td>
                                                                                  <td>".$exg->coin."</td>
                                                                                  <td>".number_format($exg->same_price, 2)."</td>
                                                                                  <td>".number_format($exg->price, 2)."</td>
                                                                                  <td>".number_format($exg->buy_fees, 2)."</td>
                                                                                  <td>".number_format($exg->final_aed, 2)."</td>
                                                                                 <td>";


                    if($exg->status == 1)
                    {  $html.="<label class='label label-success'>Success</label>";  }
                    elseif($exg->status == 3)
                    {  $html.="<label class='label label-danger'> Cancel </label>"; }
                    else
                    {    }
                    $html.="</td></tr>";
                }
                else
                {   }
            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }
        echo $html;die;
    }


    function order_middle(Request $request)
    {
        $html="";
        $type = $request->option;
        $user_id = Sentinel::getUser()->id;

        if($type == 'bid')
        {
            $exgdata = Exchange::where(array('user_id'=>$user_id))->orderBy('id','DESC')->get();
        }
        elseif($type == 'ask')
        {

            $exgdata = Exchange::where(array('user_id'=>$user_id))->orderBy('id','ASC')->get();
        }
        else
        {    }

        if(sizeof($exgdata) >= 1)
        {
            $index=1;
            foreach ($exgdata as $exg)
            {
                if($exg->status == 0 || $exg->status == 2)
                {
                    if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                    else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                    else{  }

                    $total = ($exg->price) * ($exg->same_price);
                    $html.="<tr  id='order_cancal$exg->id' onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                         <td><b>".$index++."</b></td>
                                         <td><b>".$exg->side."</b></td>
                                         <td>".$exg->order_id."</td>
                                         <td>".$exg->coin."</td>
                                         <td>".number_format($exg->same_price, 2)."</td>
                                         <td>".number_format($exg->price, 2)."</td>
                                        <td>".number_format($exg->buy_fees, 2)."</td>
                                        <td>".number_format($exg->final_aed, 2)."</td>
                                        <td>";

                    $html.="<lable onclick='cancel_order_user(".$exg->id.",".$exg->order_id.")' class='btn btn-info'>cancel</lable>";


                    $html.= "</td><td>";



                    if($exg->status == 0)
                    {  $html.="<label class='label label-warning'>Pending</label>";  }
                    elseif($exg->status == 2)
                    {  $html.="<label class='label label-info'> Partially Pay</label>"; }
                    else
                    {    }
                    $html.="</td></tr>";
                }
                else
                {   }
            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }
        echo $html;die;


    }


    public function order_full1($coin)
    {
        $html="";
        $user_id = Sentinel::getUser()->id;
        $exgdata = Exchange::where(array('user_id'=>$user_id))->orderBy('id','DESC')->get();
        if(sizeof($exgdata) >= 1)
        {
            $index=1;
            foreach ($exgdata as $exg)
            {
                if($exg->status == 0 || $exg->status == 2)
                {
                    if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                    else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                    else{  }

                    $total = ($exg->price) * ($exg->same_price);
                    $html.="<tr onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                                                              <td><b>".$index++."</b></td>
                                                                              <td><b>".$exg->side."</b></td>
                                                                              <td>".$exg->order_id."</td>
                                                                              <td>".$exg->coin."</td>
                                                                              <td>".number_format($exg->same_price, 2)."</td>
                                                                              <td>".number_format($exg->price, 2)."</td>
                                                                             <td>".number_format($exg->buy_fees, 2)."</td>
                                                                             <td>".number_format($exg->final_aed, 2)."</td>
                                                                             <td>";
                    $html.="<lable onclick='cancel_order_user(".$exg->id.",".$exg->order_id.")' class='btn btn-info'>cancel</lable>";
                    $html.= "</td><td>";

                    if($exg->status == 0)
                    {  $html.="<label class='label label-warning'>Pending</label>";  }
                    elseif($exg->status == 2)
                    {  $html.="<label class='label label-info'> Partially Pay</label>"; }
                    else {    }
                    $html.="</td></tr>";
                }
                else
                {   }
            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }

        print_r($html);
    }

    public function order_middle_1($coin)
    {
        $html="";
        $user_id = Sentinel::getUser()->id;
        $exgdata = Exchange::where(array('user_id'=>$user_id,'coin'=>strtoupper($coin)))->orderBy('same_price','DESC')->get();

        if(sizeof($exgdata) >= 1)
        {
            foreach ($exgdata as $exg)
            {
                $index=1;
                if($exg->status == 0 || $exg->status == 2)
                {
                    if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                    else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                    else{  }

                    $total = ($exg->price) * ($exg->same_price);
                    $html.="<tr id='order_cancal$exg->id'  onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                                                                    <td><b>".$index++."</b></td>
                                                                                    <td><b>".$exg->side."</b></td>
                                                                                    <td>".$exg->order_id."</td>
                                                                                    <td>".$exg->coin."</td>
                                                                                    <td>".number_format($exg->same_price, 2)."</td>
                                                                                    <td>".number_format($exg->price, 2)."</td>
                                                                                   <td>".number_format($exg->buy_fees, 2)."</td>
                                                                                  <td>".number_format($exg->final_aed, 2)."</td>                                                                                <td>";
                    $html.="<lable onclick='cancel_order_user(".$exg->id.",".$exg->order_id.")' class='btn btn-info'>cancel</lable>";
                    $html.= "</td><td>";


                    if($exg->status == 0)
                    {  $html.="<label class='label label-warning'>Pending</label>";  }
                    elseif($exg->status == 2)
                    {  $html.="<label class='label label-info'> Partially Pay</label>"; }
                    else
                    {    }
                    $html.="</td></tr>";
                }
                else
                {   }
            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }
        echo $html;die;
    }


    public function order_full_1($coin)
    {
        $html="";
        $user_id = Sentinel::getUser()->id;
        $exgdata = Exchange::where(array('user_id'=>$user_id,'coin'=>strtoupper($coin)))->orderBy('id','DESC')->get();

        if(sizeof($exgdata) >= 1)
        { $index=1;
            foreach ($exgdata as $exg)
            {
                if($exg->status == 1 || $exg->status == 3)
                {
                    if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                    else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                    else{  }

                    $total = ($exg->price) * ($exg->same_price);
                    $html.="<tr onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                                                                   
                                                                                    <td><b>". $index++."</b></td>
                                                                                    <td><b>".$exg->side."</b></td>
                                                                                    <td>".$exg->order_id."</td>
                                                                                    <td>".$exg->coin."</td>
                                                                                    <td>".number_format($exg->same_price, 2)."</td>
                                                                                    <td>".number_format($exg->price, 2)."</td>
                                                                                    <td>".number_format($exg->buy_fees, 2)."</td>
                                                                                  <td>".number_format($exg->final_aed, 2)."</td>
                                                                                   <td>";


                    if($exg->status == 1)
                    {  $html.="<label class='label label-success'>Success</label>";  }
                    elseif($exg->status == 3)
                    {  $html.="<label class='label label-danger'> Cancel </label>"; }
                    else
                    {    }
                    $html.="</td></tr>";
                }
                else
                {   }
            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }
        echo $html;die;
    }

    public function order_full_block_1($coin)
    {
        $html="";
        $user_id = Sentinel::getUser()->id;
        $exgdata = Exchange::where(array('user_id'=>$user_id,'coin'=>strtoupper($coin)))->orderBy('id','DESC')->get();

        if(sizeof($exgdata) >= 1)
        {
            $index=1;
            foreach ($exgdata as $exg)
            {

                if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                else{  }

                $total = ($exg->price) * ($exg->same_price);
                $html.="<tr onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                                                                    <td><b>".$index++."</b></td>
                                                                                    <td><b>".$exg->side."</b></td>
                                                                                    <td>".$exg->order_id."</td>
                                                                                    <td>".$exg->coin."</td>
                                                                                    <td>".number_format($exg->same_price, 2)."</td>
                                                                                    <td>".number_format($exg->price, 2)."</td>
                                                                                    <td>".number_format($exg->buy_fees, 2)."</td>
                                                                                  <td>".number_format($exg->final_aed, 2)."</td>
                                                                                   <td>";


                if($exg->status == 1)
                {  $html.="<label class='label label-success'>Success</label>"; }
                else if($exg->status == 0)
                {  $html.="<label class='label label-warning'>Pending</label>";  }
                elseif($exg->status == 2)
                { $html.="<label class='label label-info'> Partially Pay</label>"; }
                elseif($exg->status == 3)
                {  $html.="<label class='label label-danger'> Cancel </label>"; }
                else
                {    }
                $html.="</td></tr>";

            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }
        echo $html;die;
    }

    public function buy_full_coin_1($coin)
    {
        $html="";
        $user_id = Sentinel::getUser()->id;
        $exgdata = Exchange::where(array('user_id'=>$user_id,'side'=>'buy','coin'=>strtoupper($coin)))->orderBy('id','DESC')->get();

        if(sizeof($exgdata) >= 1)
        {
            foreach ($exgdata as $exg)
            {
                if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                else{  }

                $total = ($exg->price) * ($exg->same_price);
                $html.="<tr onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                                                                    <td><b>1</b></td>
                                                                                    <td>".number_format($exg->price, 2)."</td>
                                                                                     <td>".number_format($total, 2)."</td>
                                                                                    <td>".number_format($exg->same_price, 2)."</td>";
                $html.="</tr>";

            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }
        echo $html;die;
    }
    public function sell_full_coin_1($coin)
    {

        $html="";
        $user_id = Sentinel::getUser()->id;
        $exgdata = Exchange::where(array('user_id'=>$user_id,'side'=>'sell','coin'=>strtoupper($coin)))->orderBy('id','DESC')->get();

        if(sizeof($exgdata) >= 1)
        {
            foreach ($exgdata as $exg)
            {
                if($exg->side == 'buy') { $temp_class = '#fbe9e7'; }
                else if($exg->side == 'sell') { $temp_class = '#e8f5e9'; }
                else{  }

                $total = ($exg->price) * ($exg->same_price);
                $html.="<tr onclick='order_tr_call(1,".$exg->price.",".$total.",".$exg->same_price.")' style='background-color:".$temp_class."'>
                                                                                    <td><b>1</b></td>
                                                                                    <td>".number_format($exg->price, 2)."</td>
                                                                                     <td>".number_format($total, 2)."</td>
                                                                                    <td>".number_format($exg->same_price, 2)."</td>";
                $html.="</tr>";

            }
        }
        else
        {
            $html.="<tr><td><b style='color:red;'>No Data Found</b></td></tr>";
        }
        echo $html;die;
    }

    public function mybalance()
    {
        if (!Sentinel::hasAccess('currencies')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        $api = new Bitstamp();
        $data = $api->balance();

        return View('exchange.balance',compact('data'));
    }

    public function mybalancecron()
    {
        $api = new Bitstamp();
        $balance = $api->balance();

        foreach ($balance as $key => $value) {

            if (strpos($key, 'available')) {

                $coinname = strtoupper(str_replace('_available', '', $key));

                if ($coinname == 'BTC' || $coinname == 'ETH' || $coinname == 'XRP' || $coinname == 'LTC' | $coinname == 'USD') {

                    $minbal = Setting::where('setting_key', 'min_' . $coinname)->first()->setting_value;

                    $email = Setting::where('setting_key', 'admin_email')->first()->setting_value;

                    try {
                        if ($value <= $minbal) {
                            Log::alert('balance mail');
                            Mail::send('emails.lowbalance', [
                                'coin' => $coinname,
                            ], function ($message) use ($coinname, $email) {
                                $message->to($email);
                                $message->subject("low balance alert $coinname ");
                            });
                        }
                    } catch (Swift_TransportException $e) {
                    }
                }
            }
        }

    }

    public function getstatus()
    {



        Log::alert('getstatus');
        $exchange = Exchange::where('status', 0)->get();
        foreach ($exchange as $key) {
            $api = new Bitstamp();
            $create_order = $api->order_status($key->order_id);


            if ($create_order['status'] == 'Finished' && $key->side == 'buy') {


                $exchange_update = Exchange::where('order_id', $key->order_id)->first();
                $exchange_update->status = 1;
                $exchange_update->save();

                $user = User::find($key->user_id);

                if ($key->side == 'buy' && $exchange_update->coin == 'BTC')
                    $user->bitcoin_balance = $user->bitcoin_balance + $exchange_update->price;
                if ($key->side == 'buy' && $exchange_update->coin == 'ETH')
                    $user->ethereum_balance = $user->ethereum_balance + $exchange_update->price;
                if ($key->side == 'buy' && $exchange_update->coin == 'XRP')
                    $user->ripple_balance = $user->ripple_balance + $exchange_update->price;
                if ($key->side == 'buy' && $exchange_update->coin == 'LTC')
                    $user->litecoin_balance = $user->litecoin_balance + $exchange_update->price;

                $user->save();

                Log::alert('getstatus-sendmail');
                $this->sendmail($exchange_update, $user);

            } elseif ($create_order['status'] == 'Finished' && $key->side == 'sell') {
                $exchange_update = Exchange::where('order_id', $key->order_id)->first();
                $exchange_update->status = 1;
                $exchange_update->save();

                $user = User::find($key->user_id);
                if ($key->side == 'sell')
                    $user->aed_balance = $user->aed_balance + $exchange_update->final_aed;
                $user->save();
                Log::alert('getstatus-sale');
//                $this->sendmail($exchange_update, $user);
            }

        }

        // $reate = json_decode(file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=USD_AED&compact=y'));

        // if($reate)
        //     Setting::where('setting_key','aed_rate')->update(['setting_value' => round($reate->USD_AED->val,2)]);

    }

    private function sendmail($exchange,$user)
    {
        Mail::send('emails.successfulteade', [
            'user' => $user,
            'exchange' => $exchange,
        ], function ($message) use ($exchange, $user) {
            $message->to($user->email);
            $message->subject("exchange done successfull ");
        });

    }
    public function buycountshow($type,$count)
    {
        $totel = Exchange::where('side',$type)->count();

        if($count < $totel )
        {
            $limit= $totel - $count;
            $exchange  = Exchange::with('userdata')->where('side',$type)->orderby('id','desc')->limit($limit)->get();

            return  response()->json(['error' => "ok",'data'=>$exchange]);
        }
        else
            return  response()->json(['error' => "fail"]);


    }
    public function treadehistory($type)
    {
        $set_unm = Setting::where('setting_key','cex_username')->first();
        $username = $set_unm->setting_value;

        $set_api = Setting::where('setting_key','cex_api')->first();
        $api = $set_api->setting_value;

        $set_secret = Setting::where('setting_key','cex_secret')->first();
        $secret = $set_secret->setting_value;

        $aed_value = Setting::where('setting_key','aed_rate')->first();
        $aed_rate = $aed_value->setting_value;

        $api = new cexapi($username,$api,$secret);
        $treade =  $api->trade_history($type);


        $html ='<marquee scrolldelay="1000"  direction="down" height="420">';
        //        $html ="";
        foreach ($treade as $id=>$key)
        {
            $type = $key['type'];
            $html .= "<samp style='padding:0 1%;margin:0 -3px;float:left;'>" . $type . "</samp>";
            $amount = $key['amount'];
            $html .= "<samp style='padding:0 1%;float:right; width: 30%;'>" . $amount . "</samp>";
            $price = $key['price'];
            $html .= "<samp style='padding:0 0 0 0;float:right;width: 30%;'>" . $price*$aed_rate . "</samp>";
            $html .= "<br>";
        }

        $html.= '</marquee>';

        return $html;



    }



}
