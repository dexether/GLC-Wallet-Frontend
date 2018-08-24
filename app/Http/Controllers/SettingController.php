<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\ChartOfAccount;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Setting;
use App\Models\SmsGateway;
use App\Models\UserBankAccount;
use App\Models\User;
use App\Models\Exchange;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use Hash;
use App\Bitstamp;
use ShaunR\Cexio\Rest as Cexio;
use Storage;
use Mail;
use View;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['sentinel','verify_requirements'],['except' => ['uploadProfile','changePassword','updatePersonal','updateData']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSystem()
    {
        Artisan::call('migrate');
        Flash::success("Successfully Updated");
        return redirect('setting/data');
    }

    public function index(Request $request)
    {
        /**if (!Sentinel::hasAccess('settings')) {
         * Flash::warning("Permission Denied");
         * return redirect('/');
         * }**/
        $sms_gateways = array();
        foreach (SmsGateway::all() as $key) {
            $sms_gateways[$key->id] = $key->name;
        }

        $countries = array();
        foreach (Country::all() as $key) {
            $countries[$key->id] = $key->name;
        }
        $currencies = array();
        foreach (Currency::all() as $key) {
            $currencies[$key->id] = $key->name;
        }
        $data = UserBankAccount::where('user_id', Sentinel::getUser()->id)->get();

        return view('setting.data',
            compact('sms_gateways', 'countries', 'currencies', 'chart_income', 'chart_expenses', 'chart_equity', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if (!Sentinel::hasAccess('settings')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        Setting::where('setting_key', 'company_name')->update(['setting_value' => $request->company_name]);
        Setting::where('setting_key', 'company_phone')->update(['setting_value' => $request->company_phone]);
        Setting::where('setting_key', 'company_address')->update(['setting_value' => $request->company_address]);
        Setting::where('setting_key', 'company_email')->update(['setting_value' => $request->company_email]);
        Setting::where('setting_key', 'company_website')->update(['setting_value' => $request->company_website]);
        Setting::where('setting_key', 'portal_address')->update(['setting_value' => $request->portal_address]);
        Setting::where('setting_key', 'currency_symbol')->update(['setting_value' => $request->currency_symbol]);
        Setting::where('setting_key', 'currency_position')->update(['setting_value' => $request->currency_position]);
        Setting::where('setting_key', 'company_currency')->update(['setting_value' => $request->company_currency]);
        Setting::where('setting_key', 'company_country')->update(['setting_value' => $request->company_country]);
        Setting::where('setting_key', 'sms_enabled')->update(['setting_value' => $request->sms_enabled]);
        Setting::where('setting_key', 'active_sms')->update(['setting_value' => $request->active_sms]);
        Setting::where('setting_key',
            'phone_verify')->update(['setting_value' => $request->phone_verify]);
        Setting::where('setting_key',
            'email_verify')->update(['setting_value' => $request->email_verify]);
        Setting::where('setting_key',
            'documents_verify')->update(['setting_value' => $request->documents_verify]);
        Setting::where('setting_key',
            'auto_email_activation')->update(['setting_value' => $request->auto_email_activation]);
        Setting::where('setting_key',
            'cancel_withdrawal')->update(['setting_value' => $request->cancel_withdrawal]);
        Setting::where('setting_key',
            'notify_withdrawal_request')->update(['setting_value' => $request->notify_withdrawal_request]);
        Setting::where('setting_key',
            'notify_exchange_complete')->update(['setting_value' => $request->notify_exchange_complete]);
        Setting::where('setting_key',
            'custom_header_javascript')->update(['setting_value' => $request->custom_header_javascript]);
        Setting::where('setting_key',
            'custom_footer_javascript')->update(['setting_value' => $request->custom_footer_javascript]);
        Setting::where('setting_key',
            'enable_google_recaptcha')->update(['setting_value' => $request->enable_google_recaptcha]);
        Setting::where('setting_key',
            'google_recaptcha_site_key')->update(['setting_value' => $request->google_recaptcha_site_key]);
        Setting::where('setting_key',
            'google_recaptcha_secret_key')->update(['setting_value' => $request->google_recaptcha_secret_key]);
        Setting::where('setting_key',
            'password_reset_subject')->update(['setting_value' => $request->password_reset_subject]);
        Setting::where('setting_key',
            'password_reset_template')->update(['setting_value' => $request->password_reset_template]);
        Setting::where('setting_key',
            'new_account_subject')->update(['setting_value' => $request->new_account_subject]);
        Setting::where('setting_key',
            'new_account_template')->update(['setting_value' => $request->new_account_template]);
        Setting::where('setting_key',
            'withdrawal_paid_sms_template')->update(['setting_value' => $request->withdrawal_paid_sms_template]);
        Setting::where('setting_key',
            'withdrawal_paid_email_template')->update(['setting_value' => $request->withdrawal_paid_email_template]);
        Setting::where('setting_key',
            'withdrawal_paid_email_subject')->update(['setting_value' => $request->withdrawal_paid_email_subject]);
        Setting::where('setting_key',
            'withdrawal_declined_email_template')->update(['setting_value' => $request->withdrawal_declined_email_template]);
        Setting::where('setting_key',
            'withdrawal_declined_email_subject')->update(['setting_value' => $request->withdrawal_declined_email_subject]);
        Setting::where('setting_key',
            'payment_email_subject')->update(['setting_value' => $request->payment_email_subject]);
        Setting::where('setting_key',
            'payment_email_template')->update(['setting_value' => $request->payment_email_template]);
        Setting::where('setting_key',
            'sell_email_subject')->update(['setting_value' => $request->sell_email_subject]);
        Setting::where('setting_key',
            'sell_email_template')->update(['setting_value' => $request->sell_email_template]);
        Setting::where('setting_key',
            'withdrawal_request_email_subject')->update(['setting_value' => $request->withdrawal_request_email_subject]);
        Setting::where('setting_key',
            'withdrawal_request_email_template')->update(['setting_value' => $request->withdrawal_request_email_template]);
        Setting::where('setting_key',
            'non_reply_email')->update(['setting_value' => $request->non_reply_email]);
        Setting::where('setting_key',
            'cron_last_run')->update(['setting_value' => $request->cron_last_run]);
        Setting::where('setting_key',
            'enable_cron')->update(['setting_value' => $request->enable_cron]);
        Setting::where('setting_key',
            'wallet_address_limit')->update(['setting_value' => $request->wallet_address_limit]);
        Setting::where('setting_key',
            'otp_sms_template')->update(['setting_value' => $request->otp_sms_template]);

        Setting::where('setting_key',
            'wallet_address_source')->update(['setting_value' => $request->wallet_address_source]);
        Setting::where('setting_key',
            'account_accessed_notification')->update(['setting_value' => $request->account_accessed_notification]);
        Setting::where('setting_key',
            'account_accessed_email_subject')->update(['setting_value' => $request->account_accessed_email_subject]);
        Setting::where('setting_key',
            'account_accessed_email_template')->update(['setting_value' => $request->account_accessed_email_template]);
        Setting::where('setting_key',
            'enable_withdrawal_otp')->update(['setting_value' => $request->enable_withdrawal_otp]);
        Setting::where('setting_key',
            'enable_partial_order_fulfilment')->update(['setting_value' => $request->enable_partial_order_fulfilment]);
        Setting::where('setting_key',
            'site_online')->update(['setting_value' => $request->site_online]);
        Setting::where('setting_key',
            'enable_frontend')->update(['setting_value' => $request->enable_frontend]);
        Setting::where('setting_key',
            'enable_coin_to_coin')->update(['setting_value' => $request->enable_coin_to_coin]);
        Setting::where('setting_key',
            'order_expire_days')->update(['setting_value' => $request->order_expire_days]);

        Setting::where('setting_key','cex_username')->update(['setting_value' => $request->cex_username]);
        Setting::where('setting_key','cex_api')->update(['setting_value' => $request->cex_api]);
        Setting::where('setting_key','cex_secret')->update(['setting_value' => $request->cex_secret]);
        Setting::where('setting_key','aed_rate')->update(['setting_value' => $request->aed_rate]);
        Setting::where('setting_key','buy_percentage')->update(['setting_value' => $request->buy_percentage]);
        Setting::where('setting_key','sell_percentage')->update(['setting_value' => $request->sell_percentage]);
        Setting::where('setting_key','min_BTC')->update(['setting_value' => $request->min_BTC]);
        Setting::where('setting_key','min_ETH')->update(['setting_value' => $request->min_ETH]);
        Setting::where('setting_key','min_XRP')->update(['setting_value' => $request->min_XRP]);
        Setting::where('setting_key','min_LTC')->update(['setting_value' => $request->min_LTC]);
        Setting::where('setting_key','min_USD')->update(['setting_value' => $request->min_USD]);


        if ($request->hasFile('company_logo')) {
            $file = array('company_logo' => $request->file('company_logo'));
            $rules = array('company_logo' => 'required|mimes:jpeg,jpg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                Flash::warning(trans('general.validation_error'));
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                Setting::where('setting_key',
                    'company_logo')->update(['setting_value' => $request->file('company_logo')->getClientOriginalName()]);
                $request->file('company_logo')->move(public_path() . '/uploads',
                    $request->file('company_logo')->getClientOriginalName());
            }
        }

        GeneralHelper::audit_trail("Updated Settings");
        Flash::success("Successfully Saved");
        return redirect('setting/data');
    }

    public function announcement(Request $request)
    {

        if (!Sentinel::hasAccess('settings')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        if ($request->isMethod('post')) {
            Setting::where('setting_key',
                'announcement')->update(['setting_value' => $request->announcement]);
            Setting::where('setting_key',
                'announcement_type')->update(['setting_value' => $request->announcement_type]);
            GeneralHelper::audit_trail("Updated Settings");
            Flash::success("Successfully Saved");
            return redirect()->back();
        }
        return view('setting.announcement',
            compact(''));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadProfile(Request $request)
    {

        if ($request->hasFile('images')) {
            $destinationPath = "assets/profile";
            $files = $request->images;
            $extension = $files->extension();
            $filename1 = time() . "_" . rand() . "." . $extension;
            $filename1 = urlencode($filename1);
            $files->move(public_path($destinationPath), $filename1);

            $user = User::find(Sentinel::getUser()->id);
            $user->profile_pic = $filename1;
            $user->save();
            return 1;
        }
    }

    public function updateData(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $user = User::find(Sentinel::getUser()->id);
        $user->name = $request->nickName;
        $user->email = $request->email;
        $user->save();
        Flash::success("Data updated Successfully");
        return redirect()->back()->with('success', "Data updated Successfully");
    }

    public function updatePersonal(Request $request)
    {
        $dob = $request->day . "/" . $request->month . "/" . $request->year;
        $address = $request->street . "|" . $request->street_2 . "|" . $request->city . "|" . $request->state . "|" . $request->postcode;
        $user = User::find(Sentinel::getUser()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->dob = $dob;
        $user->address = $address;
        $user->city = $request->city;
        $user->country_id = $request->country_id;
        $user->save();
        Flash::success("Personal Data updated Successfully");
        return redirect()->back()->with('success', "Personal Data updated Successfully");
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
//            'new_password' => 'required|min:6|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/',
            'new_password' => 'required|min:6',
            'confirm_password' => 'same:new_password'
        ]);
        $old_password = $request->old_password;
        $current_password = Sentinel::getUser()->password;
        $id = Sentinel::getUser()->id;
        if (Hash::check($old_password, $current_password)) {
            $user = User::find($id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            Flash::success("Your password updated Successfully");
            return redirect()->back()->with('success', "Your password updated Successfully");
        } else {
            Flash::warning("Invalid  Old password. Please try again");
            return redirect()->back()->with('error', "Invalid  Old password. Please try again");
        }
    }


    public function democallnew($coin = "XRP")
    {
        $html="";
        $set_unm = Setting::where('setting_key','cex_username')->first();
        $username = $set_unm->setting_value;

        $set_api = Setting::where('setting_key','cex_api')->first();
        $api = $set_api->setting_value;

        $set_secret = Setting::where('setting_key','cex_secret')->first();
        $secret = $set_secret->setting_value;

        $coin = strtoupper($coin.'/'.'USD');
        $api = new cexapi($username,$api,$secret);
//        return $api->signature();
         $full_array =  $api->order_book($coin);

        // $timestamp =  $full_array['timestamp'];
        return  response()->json($array = $full_array);

        return view('democall',compact('array'));
    }

    public function placeorderbuy(Request $request)
    {

        $user = Sentinel::getuser()->id;

        $marks = array('BTC', 'ETH', 'XRP','LTC');

        if (!in_array($request->type, $marks))
            return response()->json(['error' => 'LTC will be add in exchange later , for now it when disabled']);

        Storage::disk('local')->put($user . '__' . time() . 'cron-job.txt', json_encode($request->all()));

        $buy_percentage = Setting::where('setting_key', 'buy_percentage ')->first()->setting_value;

//        $request=(json_decode($request->body));

        $buy = $request->USD * $request->COIN;
        $buy_fee = $buy * $buy_percentage / 100;

        $buy = $buy + $buy * $buy_percentage / 100;

        if (Sentinel::getuser()->aed_balance < $buy) {
            $array= ['reason'=>'insufficient balance'];
            return response()->json($array);
        }

        $aed_value = Setting::where('setting_key', 'aed_rate')->first();
        $aed_rate = $aed_value->setting_value;


         $pass_type = 'buy';
         $pass_amount = round($request->COIN,4);
          $pass_price = round($request->USD / $aed_rate,4);
         $pass_couple = strtolower($request->type. 'USD');
         $api = new Bitstamp();


        if ($request->order_type == "market")
             $create_order = $api->buymarket($pass_couple, $pass_amount,$pass_price);
        else
            $create_order = $api->buy($pass_couple,$pass_amount,$pass_price);

        Storage::disk('local')->put($user . '__' . time() . 'newBitstamp.txt', json_encode($create_order));


        if (array_key_exists("status", $create_order)) {
            return response()->json($create_order);
        } else {
            $exchange = new  Exchange();
            $exchange->user_id = Sentinel::getuser()->id;
            $exchange->order_id = $create_order['id'];
            $exchange->symbol = $request->type . '/AED';
            $exchange->coin = $request->type;
            $exchange->exchange = 'bitstamp';
            $exchange->price = $create_order['amount'];
            $exchange->same_price = $request->USD;
            $exchange->buy_fees = $buy_fee;
            $exchange->final_aed = round($buy,4);
            $exchange->side = 'buy';
            $exchange->type = 'exchange limit';
            $exchange->timestamp = $create_order['datetime'];
            $exchange->status = 0;
            $exchange->save();

            $user = User::find($exchange->user_id);
            $user->aed_balance = $user->aed_balance - $exchange->final_aed;
            $user->save();

           $this->teademail($exchange,$user);

           return  response()->json(['reason' => 'order place successfully']);

        }
    }

    public function placeordersell(Request $request)
    {
          $user = Sentinel::getuser()->id;
        Storage::disk('local')->put($user.'__'.time().'cron-job.txt', $request->all());


        $marks = array('BTC', 'ETH', 'XRP','LTC');

        if (!in_array($request->type, $marks))
            return response()->json(['error' => 'LTC will be add in exchange later , for now it when disabled']);


//        $request=(json_decode($request->body));

        $coinname = strtolower($request->type).'balance';

        $sell_percentage = Setting::where('setting_key', 'sell_percentage ')->first()->setting_value;


        $sell = $request->USD * $request->COIN;
        $sell_fee = $sell * $sell_percentage / 100;
         $sell = $sell - $sell * $sell_percentage / 100;

        if ($request->type == 'BTC')
            $coin_show = 'bitcoin_balance';
        if ($request->type == 'ETH')
            $coin_show = 'ethereum_balance';
        if ($request->type == 'LTC')
            $coin_show = 'litecoin_balance';
        if ($request->type == 'XRP')
            $coin_show = 'ripple_balance';


        if (Sentinel::getuser()->$coin_show < $request->COIN)
        {
            $array= ['reason'=>'insufficient balance'];
            return  response()->json($array);
        }

        $aed_value = Setting::where('setting_key','aed_rate')->first();
        $aed_rate = $aed_value->setting_value;

        $pass_type = 'sell';
        $pass_amount = $request->COIN;
         $pass_price = $request->USD / $aed_rate;
        $pass_couple = strtolower($request->type. 'USD');
       $api = new Bitstamp();
// return [$pass_couple, $pass_amount, $pass_price];
        if ($request->order_type == "market")
               $create_order = $api->sellmarket($pass_couple, $pass_amount, $pass_price);
        else
              $create_order = $api->sell($pass_couple, $pass_amount, $pass_price);


        Storage::disk('local')->put($user . '__' . time() . 'newBitstamp.txt', json_encode($create_order));

        if (array_key_exists("status", $create_order)) {
            return response()->json($create_order);
        } else {

            $exchange = new  Exchange();
            $exchange->user_id = Sentinel::getuser()->id;
            $exchange->order_id = $create_order['id'];
            $exchange->symbol = $request->type . '/AED';
            $exchange->coin = $request->type;
            $exchange->exchange = 'bitfinex';
            $exchange->price =  $create_order['amount'];
            $exchange->same_price = $request->USD;
            $exchange->buy_fees = $sell_fee;
            $exchange->final_aed = round($sell,4);
            $exchange->side = 'sell';
            $exchange->type = 'exchange limit';
            $exchange->timestamp = $create_order['datetime'];
            $exchange->status = 0;
            $exchange->save();


            $user = User::find($exchange->user_id);
            if ($exchange->coin == 'BTC' && $exchange->side="sell")
                $user->bitcoin_balance = $user->bitcoin_balance - $exchange->price;
            if ($exchange->coin == 'ETH'&& $exchange->side="sell")
                $user->ethereum_balance = $user->ethereum_balance - $exchange->price;
            if ($exchange->coin == 'LTC'&& $exchange->side="sell")
                $user->litecoin_balance = $user->litecoin_balance - $exchange->price;
            if ($exchange->coin == 'XRP'&& $exchange->side="sell")
                $user->ripple_balance = $user->ripple_balance - $exchange->price;

            $user->save();

             $this->teademail($exchange,$user);

            return  response()->json(['reason' => 'order place successfully']);
        }

        return  response()->json($create_order);
//        return view('democall',compact('array'));
    }


    public function cancelorder(Request $request)
{

       $exchange = Exchange::where('status', 0)->where('order_id', $request->order_id)->where('user_id', Sentinel::getuser()->id)->first();
        $api = new Bitstamp();
        $order_status = $api->order_status($exchange->order_id);
        
    if ($exchange && $order_status['status'] == 'Open' ) {
        $aed_value = Setting::where('setting_key', 'aed_rate')->first();
        $aed_rate = $aed_value->setting_value;

         $api = new Bitstamp();
         
       
          $create_order = $api->cancel_order($request->order_id);

        $user = Sentinel::getuser()->id;

        Storage::disk('local')->put($user . '__' . time() . 'canseal_order.txt', json_encode($create_order));


        if (is_array ($create_order) > 1) {
            
            return response()->json($create_order);
        } else {
            
            $exchange = Exchange::where('order_id', $request->order_id)->first();
            $exchange->status = 3;
            $exchange->save();


            $user = User::find($exchange->user_id);
            if ($exchange->coin == 'BTC' && $exchange->side == "sell")
                $user->bitcoin_balance = $user->bitcoin_balance + $exchange->price;
            if ($exchange->coin == 'ETH' && $exchange->side == "sell")
                $user->ethereum_balance = $user->ethereum_balance + $exchange->price;
            if ($exchange->coin == 'LTC' && $exchange->side == "sell")
                $user->litecoin_balance = $user->litecoin_balance + $exchange->price;
            if ($exchange->coin == 'XRP' && $exchange->side == "sell")
                $user->ripple_balance = $user->ripple_balance + $exchange->price;

            if ($exchange && $exchange->side == "buy")
                $user->aed_balance = $user->aed_balance + $exchange->final_aed;
            $user->save();

             $this->teademailcanseal($exchange,$user);
            return response()->json(['reason' => "order cancel successfully"]);

        }
    } else {
        return response()->json(['reason' => "invalid action"]);

    }
}
    public function mybalance()
    {
        $api = new Bitstamp();
        return  $data = $api->balance();

    }

    public function teademail($exchange,$user)
    {
//        return View('emails.exchangebuyesell',compact('exchange','user'));
            Mail::send('emails.exchangebuyesell', [
                'user' => $user,
                'exchange' => $exchange,
            ], function ($message) use ($user,$exchange) {
                $message->to($user->email);
                $message->subject( $exchange->side.' '. $exchange->side  .'');
            });
    }
    public function teademailcanseal($exchange,$user)
    {
//        return View('emails.exchangecanceal',compact('exchange','user'));
        Mail::send('emails.exchangecanceal', [
            'user' => $user,
            'exchange' => $exchange,
        ], function ($message) use ($user,$exchange) {
            $message->to($user->email);
            $message->subject( $exchange->side.' '. $exchange->side  .'');
        });
    }

    public function democall()
    {
        $api ='tqZ71x7Tq5fgq7ecLp6Lwge64hjpR3wz';
        $secret ='rxgqY4f21tkTfbxSaeBHfsnOe64g2d5l';

        $api = new Bitstamp($api, $secret);
        $api->cancel_all_orders();
//        return $api->sellmarket("xrpusd",10,  10, 0.05);/**/
//
    }




}
