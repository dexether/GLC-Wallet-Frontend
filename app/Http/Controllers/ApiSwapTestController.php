<?php

namespace App\Http\Controllers;

use App\Events\UserRegistration;
use App\Helpers\GeneralHelper;
use App\Models\Borrower;
use App\Models\OfflineWallet;
use App\Models\Setting;
use App\Models\TradeCurrency;
use App\Models\User;
use App\Models\WalletAddress;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use ReCaptcha\ReCaptcha;
use Sentinel;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use App\Http\Requests;

use neto737\BitGoSDK\BitGoSDK;
use neto737\BitGoSDK\BitGoExpress;
use neto737\BitGoSDK\Enum\CurrencyCode;

class ApiSwapTestController extends Controller
{
    public function __construct()
    {
        if (Sentinel::check()) {
            return redirect('dashboard')->send();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        return view('errors.curtisTesting');
    }

    public function error()
    {
        return view('errors.general_error');
    }

    public function login()
    {
        return view('login');
    }

    public function reset()
    {
        return view('reset');
    }

    public function register()
    {


        return view('register');
    }


    public function adminLogin()
    {
        return view('admin_login');
    }

    public function logout()
    {
        GeneralHelper::audit_trail("Logged out of system");
        Sentinel::logout(null, true);
        return redirect('/');
    }

    public function processLogin(Request $request)
    {
        $rules = array(
            'email' => 'required',
            'password' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if (Setting::where('setting_key', 'enable_google_recaptcha')->first()->setting_value == 1) {
            //check captcha
            $recaptcha = new ReCaptcha(Setting::where('setting_key',
                'google_recaptcha_secret_key')->first()->setting_value);

            $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            if (!$resp->isSuccess()) {
                Flash::warning("Something went wrong with reCaptca");
                return redirect()->back()->withInput();
            }
        }
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            //process validation here
            $credentials = array(
                "email" => Input::get('email'),
                "password" => Input::get('password'),
            );
            if (Input::get('remember')) {
                $remember = true;
            } else {
                $remember = false;
            }
            try {
                if (Sentinel::authenticate($credentials, $remember)) {
                    GeneralHelper::audit_trail("Logged in to system");
                    return redirect('dashboard');
                } else {
                    //return back
                    Flash::warning(trans('general.invalid_login_details'));
                    return redirect()->back()->withInput()->withErrors(trans('general.invalid_login_details'));
                }
            } catch (ThrottlingException $ex) {
                Flash::warning(trans('general.too_many_login_attempts'));
                return redirect()->back()->withInput()->withErrors(trans('general.too_many_login_attempts'));
            } catch (NotActivatedException $ex) {
                Flash::warning(trans('general.account_not_activated'));
                return redirect()->back()->withInput()->withErrors(trans('general.account_not_activated'));
            }
        }
    }

    public function processRegister()
    {
        $rules = array(
            'email' => 'required|unique:users',
            'password' => 'required',
            'repeat_password' => 'required|same:password',
            'first_name' => 'required',
            'phone' => 'required|numeric',
            'last_name' => 'required',
            'terms' => 'required',
            'code' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Flash::warning(trans_choice('general.validation_failed', 1));
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            //process validation here
            $credentials = array(
                "email" =>Input::get('email'),
                "password" => Input::get('password'),
                "phone" => Input::get('code').Input::get('phone'),
                "first_name" => Input::get('first_name'),
                "last_name" => Input::get('last_name'),
                "otp" => rand(20000, 29999)
            );
            //check to see if activation is auto

            if (Setting::where('setting_key', 'auto_email_activation')->first()->setting_value == 1) {

//                $credentials["email_verified"] = 1;
                $credentials["email_verified"] = 0;
                $user = Sentinel::registerAndActivate($credentials);
                $role = Sentinel::findRoleBySlug('client');
                $role->users()->attach($user);
                Sentinel::authenticate($credentials);

                   // Genrate Bitgo Wallet

            // $lable = Sentinel::getUser()->first_name.'-'.Sentinel::getUser()->last_name;
             $lable = Input::get('first_name').'-'.Input::get('last_name');
             $walletPassword = 'jUuVZc1C'; // genrate paassword
            
             $setting = Setting::where('setting_key','access_token')->first();
               $token = $setting->setting_value;
               
            // $token = 'v2x504feb3660aa6950200858c866e414a444e53a970964f4de3c9ef630f5849a07';
            $enterprise = '5b03a4e8af2039c0072287e91086ff31';
            $hostname = '209.97.136.12';
            $port = '80';

            //$coin = $request->coin;
            $coin = array('tbtc', 'teth', 'txrp', 'tltc');
            // print_r($coin);
            // die();
            

            
            foreach($coin as $value) {
            $bitgoExpress = new BitGoExpress($hostname, $port, $value);
            $bitgoExpress->accessToken = $token;
            $generateWallet = $bitgoExpress->generateWallet($lable,$walletPassword,NULL,NULL,NULL,$enterprise);
        
            $walletId = $generateWallet['id'];            
          
            
            $bitgo = new BitGoSDK($token, $value, true);
            $bitgo->walletId = $walletId;
            $url ='http://exchange.dsss.in/webhook/bitgo';
            $type = 'transaction';
            $webhook = $bitgo->addWalletWebhook($url,$type,6);
            
            // print_r($webhook);
            // die();
            
            
          if($value == 'tbtc') {
            $coins = 'bitcoin';
            $walletCoin = 'btc_wallet_id';
          } elseif ($value == 'teth') {
            $coins = 'ethereum';
            $walletCoin = 'eth_wallet_id';
          } elseif ($value == 'txrp') {
            $coins = 'ripple';
            $walletCoin = 'xrp_wallet_id';
          } elseif ($value == 'tltc') {
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
        $wallet_address->coin = $value;
        $wallet_address->current = 1;
        $wallet_address->wallet_id = $walletId;
        $wallet_address->save();

        User::where('id', Sentinel::check()->id)->update([$walletCoin => $walletId]);
    }
          
            }          

                
                //generate user wallets
                $btc = TradeCurrency::where('network', "bitcoin")->first();
                $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
                $ltc = TradeCurrency::where('network', "litecoin")->first();
                $eth = TradeCurrency::where('network', "ethereum")->first();
                $xrp = TradeCurrency::where('network', "ripple")->first();
                if (Setting::where('setting_key',
                        'wallet_address_source')->first()->setting_value == "1"
                ) {
                    // //use block io
                    // $block_io = new \BlockIo($btc->api_key, $btc->secret_key, 2);
                    // $address = $block_io->get_new_address();
                    // if ($address->status == "success") {
                    //     $wallet_address = new WalletAddress();
                    //     $wallet_address->user_id = Sentinel::getUser()->id;
                    //     $wallet_address->trade_currency_id = $btc->id;
                    //     $wallet_address->address = $address->data->address;
                    //     $wallet_address->current = 1;
                    //     $wallet_address->save();
                    // }
                    // $block_io = new \BlockIo($dogecoin->api_key, $dogecoin->secret_key, 2);
                    // $address = $block_io->get_new_address();
                    // if ($address->status == "success") {
                    //     $wallet_address = new WalletAddress();
                    //     $wallet_address->user_id = Sentinel::getUser()->id;
                    //     $wallet_address->trade_currency_id = $dogecoin->id;
                    //     $wallet_address->address = $address->data->address;
                    //     $wallet_address->current = 1;
                    //     $wallet_address->save();
                    // }
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
                    }
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
                    }
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
                    }
                }
                //eth
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
                }
                //xrp
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

                }

                Flash::success(trans('general.successfully_registered'));
                return redirect('dashboard');

            } else {
                //register user and send activation email
                $user = Sentinel::register($credentials);
                $role = Sentinel::findRoleBySlug('client');
                $role->users()->attach($user);
                $btc = TradeCurrency::where('network', "bitcoin")->first();
                $dogecoin = TradeCurrency::where('network', "dogecoin")->first();
                $ltc = TradeCurrency::where('network', "litecoin")->first();
                $eth = TradeCurrency::where('network', "ethereum")->first();
                $xrp = TradeCurrency::where('network', "ripple")->first();
                if (Setting::where('setting_key',
                        'wallet_address_source')->first()->setting_value == "1"
                ) {
                    //use block io
                    $block_io = new \BlockIo($btc->api_key, $btc->secret_key, 2);
                    $address = $block_io->get_new_address();
                    if ($address->status == "success") {
                        $wallet_address = new WalletAddress();
                        $wallet_address->user_id = $user->id;
                        $wallet_address->trade_currency_id = $btc->id;
                        $wallet_address->address = $address->data->address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                    }
                    $block_io = new \BlockIo($dogecoin->api_key, $dogecoin->secret_key, 2);
                    $address = $block_io->get_new_address();
                    if ($address->status == "success") {
                        $wallet_address = new WalletAddress();
                        $wallet_address->user_id = $user->id;
                        $wallet_address->trade_currency_id = $dogecoin->id;
                        $wallet_address->address = $address->data->address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
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
                        $wallet_address->user_id = $user->id;
                        $wallet_address->trade_currency_id = $btc->id;
                        $wallet_address->address = $address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                    }
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
                        $wallet_address->user_id = $user->id;
                        $wallet_address->trade_currency_id = $dogecoin->id;
                        $wallet_address->address = $address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                    }
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
                        $wallet_address->user_id = $user->id;
                        $wallet_address->trade_currency_id = $ltc->id;
                        $wallet_address->address = $address;
                        $wallet_address->current = 1;
                        $wallet_address->save();
                    }
                }
                //eth
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
                    $wallet_address->user_id =$user->id;
                    $wallet_address->trade_currency_id = $eth->id;
                    $wallet_address->address = $address;
                    $wallet_address->current = 1;
                    $wallet_address->save();
                }
                //xrp
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
                    $wallet_address->user_id = $user->id;
                    $wallet_address->trade_currency_id = $xrp->id;
                    $wallet_address->address = $address;
                    $wallet_address->current = 1;
                    $wallet_address->save();


                }
                event(new UserRegistration($user));

                Flash::success(trans('general.successfully_registered_check_email'));
                return redirect('login');
            }


        }
    }

    public function activateUser($code, $id)
    {

        $user = Sentinel::findById($id);
        if ($user) {
            if (Activation::complete($user, $code)) {
                // Activation was successful
                Sentinel::login($user);
                $user = User::find($user->id);
                $user->email_verified = 1;
                $user->save();
                Flash::success(trans('general.successfully_activated'));
                return redirect('dashboard');
            } else {
                // Activation not found or not completed.
                Flash::success(trans('general.record_not_found'));
                return redirect('login');
            }
        } else {
            Flash::success(trans('general.record_not_found'));
            return redirect('login');
        }
        return view('register');
    }

    /*
     * Password Resets
     */
    public function passwordReset()
    {
        $rules = array(
            'email' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            //process validation here
            $credentials = array(
                "email" => Input::get('email'),
            );
            $user = Sentinel::findByCredentials($credentials);
            if (!$user) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(trans('general.record_not_found'));
            } else {
                $reminder = Reminder::exists($user) ?: Reminder::create($user);
                $code = $reminder->code;
                $body = Setting::where('setting_key', 'password_reset_template')->first()->setting_value;
                $body = str_replace('{name}', $user->first_name . " " . $user->first_name, $body);
                $body = str_replace('{firstName}', $user->first_name, $body);
                $body = str_replace('{lastName}', $user->last_name, $body);
                $body = str_replace('{resetLink}', url('/reset/' . $user->id . '/' . $code), $body);
                Mail::raw($body, function ($message) use ($user) {
                    $message->from(Setting::where('setting_key', 'non_reply_email')->first()->setting_value,
                        Setting::where('setting_key', 'company_name')->first()->setting_value);
                    $message->to($user->email);
                    $message->setContentType('text/html');
                    $message->setSubject(Setting::where('setting_key',
                        'password_reset_subject')->first()->setting_value);
                });
                Flash::success(trans('login.reset_sent'));
                return redirect()->back()
                    ->withSuccess(trans('login.reset_sent'));
            }

        }
    }

    public function confirmReset($id, $code)
    {
        return view('reset_confirm', compact('id', 'code'));
    }

    public function completeReset(Request $request, $id, $code)
    {
        $rules = array(
            'password' => 'required',
            'repeat_password' => 'required|same:password',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            //process validation here

            $user = Sentinel::findById($id);
            if (!$user) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(trans('general.record_not_found'));
            }
            if (!Reminder::complete($user, $code, Input::get('password'))) {
                Flash::warning(trans('general.expired_code'));
                return redirect()->to('login')
                    ->withErrors(trans('general.expired_code'));
            } else {
                $credentials = array(
                    "email" => $user->email,
                    "password" => Input::get('password'),
                );
                Flash::success(trans('general.reset_success'));
                Sentinel::authenticate($credentials);
                return redirect('dashboard');
            }

        }
    }

    //client functions

    public function clientLogin(Request $request)
    {
        if ($request->session()->has('uid')) {
            //user is logged in
            return redirect('client_dashboard');
        }
        return view('client_login');
    }

    public function processClientLogin(Request $request)
    {
        if (Borrower::where('username', $request->username)->where('password', md5($request->password))->count() == 1) {
            $borrower = Borrower::where('username', $request->username)->where('password',
                md5($request->password))->first();
            //session('uid',$borrower->id);
            if ($borrower->active == 1) {
                $request->session()->put('uid', $borrower->id);
                return redirect('client')->with('msg', "Logged in");
            } else {
                Flash::warning(trans_choice('general.account_not_active', 1));
                return redirect('client')->with('error', trans_choice('general.account_not_active', 1));
            }
        } else {
            //no match
            Flash::warning(trans_choice('general.invalid_login_details', 1));
            return redirect('client')->with('error', trans_choice('general.invalid_login_details', 1));
        }
    }

    public function clientLogout(Request $request)
    {
        $request->session()->forget('uid');
        return redirect('client');

    }

    public function clientDashboard(Request $request)
    {
        if ($request->session()->has('uid')) {
            $borrower = Borrower::find($request->session()->get('uid'));
            return view('client.dashboard', compact('borrower'));
        }
        return view('client_login');

    }

    public function clientProfile(Request $request)
    {
        if ($request->session()->has('uid')) {
            $borrower = Borrower::find($request->session()->get('uid'));
            return view('client.profile', compact('borrower'));
        }
        return view('client_login');

    }

    public function processClientProfile(Request $request)
    {
        if ($request->session()->has('uid')) {
            $rules = array(
                'repeatpassword' => 'required|same:password',
                'password' => 'required'
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                Flash::warning('Passwords do not match');
                return redirect()->back()->withInput()->withErrors($validator);

            } else {
                $borrower = Borrower::find($request->session()->get('uid'));
                $borrower->password = md5($request->password);
                $borrower->save();
                Flash::success('Successfully Saved');
                return redirect('client_dashboard')->with('msg', "Successfully Saved");
            }
            $borrower = Borrower::find($request->session()->get('uid'));
            return view('client.profile', compact('borrower'));
        }
        return view('client_login');

    }



}
