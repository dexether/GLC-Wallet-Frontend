<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//route model binding
Route::model('custom_field', 'App\Models\CustomField');
Route::model('deposit', 'App\Models\Deposit');
Route::model('setting', 'App\Models\Setting');
Route::model('withdrawal', 'App\Models\Withdrawal');
Route::model('payment_gateway', 'App\Models\PaymentGateway');
Route::model('withdrawal_method', 'App\Models\WithdrawalMethod');
Route::model('wallet_address', 'App\Models\WalletAddress');
Route::model('trade_history', 'App\Models\TradeHistory');
Route::model('order', 'App\Models\OrderBook');
Route::model('referral_commission', 'App\Models\ReferralCommission');
Route::model('user', 'App\Models\User');
Route::model('trade_currency', 'App\Models\TradeCurrency');
Route::model('sms_gateway', 'App\Models\SmsGateway');
Route::model('user_bank_account', 'App\Models\UserBankAccount');
Route::model('offline_wallet', 'App\Models\OfflineWallet');
Route::model('order_fulfilment', 'App\Models\OrderFulfilment');
Route::model('page', 'App\Models\Page');

//bitgo callback for deposit
  Route::post('webhook/bitgo', 'BitgoController@webhookCallback');
  Route::get('testWithdraw', 'BitgoController@testWithdraw');
  
  
Route::group(['middleware'=>'sentinel','verify_requirements'], function()
{
//route for installation
Route::get('/dashboard-exchange','DashboardController@index');
Route::get('/dashboard-exchange/{coin}','DashboardController@index');

    Route::get('new_dashboard', function (){
        return view('dashboard1');
    });

});


Route::get('install', 'InstallController@index');
Route::group(['prefix' => 'install'], function () {
Route::get('start', 'InstallController@index');
Route::get('requirements', 'InstallController@requirements');
Route::get('permissions', 'InstallController@permissions');
Route::any('database', 'InstallController@database');
Route::any('installation', 'InstallController@installation');
Route::get('complete', 'InstallController@complete');


});
//cron route
Route::get('cron', 'CronController@index');
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return redirect('/');

});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return redirect('/');
});

Route::get('/', 'HomeController@index');
Route::get('error', 'HomeController@error');
Route::get('login', 'HomeController@login');
Route::get('admin', 'HomeController@adminLogin');

Route::get('logout', 'HomeController@logout');
Route::post('login', 'HomeController@processLogin');
Route::get('register', 'HomeController@register');
Route::post('register', 'HomeController@processRegister');
Route::get('register/activate/{code}/{id}', 'HomeController@activateUser');
Route::get('reset', 'HomeController@reset');
Route::post('reset', 'HomeController@passwordReset');
Route::get('reset/{id}/{code}', 'HomeController@confirmReset');
Route::post('reset/{id}/{code}', 'HomeController@completeReset');
Route::get('check/{id}', 'HomeController@checkStatus');
Route::get('dashboard', ['middleware' => ['sentinel', 'verify_requirements'],
    function () {

        $loans_released_monthly = array();
        $loan_collections_monthly = array();
        $date = date("Y-m-d");
        $start_date1 = date_format(date_sub(date_create($date),
            date_interval_create_from_date_string('1 years')),
            'Y-m-d');
        $start_date2 = date_format(date_sub(date_create($date),
            date_interval_create_from_date_string('1 years')),
            'Y-m-d');
        $loans_released_monthly = json_encode($loans_released_monthly);
        $loan_collections_monthly = json_encode($loan_collections_monthly);

        return view('dashboard',
            compact('monthly_actual_expected_data', 'monthly_disbursed_loans_data'));
    }
]);



Route::get('/newdashboard', 'DashController@index');
//route for custom fields
Route::group(['prefix' => 'custom_field'], function () {

    Route::get('data', 'CustomFieldController@index');
    Route::get('create', 'CustomFieldController@create');
    Route::post('store', 'CustomFieldController@store');
    Route::get('{custom_field}/show', 'CustomFieldController@show');
    Route::get('{custom_field}/edit', 'CustomFieldController@edit');
    Route::post('{id}/update', 'CustomFieldController@update');
    Route::get('{id}/delete', 'CustomFieldController@delete');

});


Route::get('update',
    function () {
        \Illuminate\Support\Facades\Artisan::call('migrate');
        \Laracasts\Flash\Flash::success("Successfully Updated");
        return redirect('/');
    });
Route::get('migrate_seed',
    function () {
        \Illuminate\Support\Facades\Artisan::call('migrate');
        \Illuminate\Support\Facades\Artisan::call('db:seed');
        \Laracasts\Flash\Flash::success("Successfully Installed");
        return redirect('/');
    });
Route::group(['prefix' => 'update'], function () {
    Route::get('download', 'UpdateController@download');
    Route::get('install', 'UpdateController@install');
    Route::get('clean', 'UpdateController@clean');
    Route::get('finish', 'UpdateController@finish');
});

//route for setting
Route::any('announcement', 'SettingController@announcement');
Route::group(['prefix' => 'setting'], function () {
    Route::get('data', 'SettingController@index');
    Route::post('upload-profile', ['as'=>'uploadprofile' , 'uses'=>'SettingController@uploadProfile']);//update profile picture 
    Route::post('update-data', ['as'=>'updatedata' , 'uses'=>'SettingController@updateData']); //update profile data
    Route::post('update-personal', ['as'=>'updatepersonal' , 'uses'=>'SettingController@updatePersonal']);//update personal data
    Route::post('change-password', ['as'=>'changepassword' , 'uses'=>'SettingController@changePassword']);//update personal data

    Route::post('update', 'SettingController@update');
    Route::get('update_system', 'SettingController@updateSystem');
});
//route for user
Route::group(['prefix' => 'user'], function () {
    Route::get('data', 'UserController@index');
    Route::get('create', 'UserController@create');
    Route::post('store', 'UserController@store');
    Route::get('{user}/edit', 'UserController@edit');
    Route::get('{user}/show', 'UserController@show');
    Route::get('{user}/verified/{id}', 'UserController@verified');
    Route::post('{id}/update', 'UserController@update');
    Route::get('{id}/delete', 'UserController@delete');
    Route::get('profile', 'UserController@profile');
    Route::post('profile', 'UserController@profileUpdate');
    Route::get('verify_email', 'UserController@verify_email');
    Route::get('verify_phone', 'UserController@verify_phone');
    Route::get('verify_documents', 'UserController@verify_documents');
    Route::get('verify_phone/send_otp/{id}', 'UserController@send_otp');
    Route::get('verify_email/send_otp', 'UserController@email_send_otp');
    Route::post('verify_phone/check_otp', 'UserController@check_otp');
    Route::post('verifyemail/checkotp', 'UserController@emailcheckotp');
    Route::post('verify_documents/check_documents', 'UserController@check_documents');
    //manage permissions
    Route::get('permission/data', 'UserController@indexPermission');
    Route::get('permission/create', 'UserController@createPermission');
    Route::post('permission/store', 'UserController@storePermission');
    Route::get('permission/{permission}/edit', 'UserController@editPermission');
    Route::post('permission/{id}/update', 'UserController@updatePermission');
    Route::get('permission/{id}/delete', 'UserController@deletePermission');
    //manage roles
    Route::get('role/data', 'UserController@indexRole');
    Route::get('role/create', 'UserController@createRole');
    Route::post('role/store', 'UserController@storeRole');
    Route::get('role/{id}/edit', 'UserController@editRole');
    Route::post('role/{id}/update', 'UserController@updateRole');
    Route::get('role/{id}/delete', 'UserController@deleteRole');

});

//loan repayment list
Route::get('repayment/data', 'LoanController@indexRepayment');
Route::get('repayment/create', 'LoanController@addRepayment');
Route::get('repayment/bulk/create', 'LoanController@createBulkRepayment');
Route::post('repayment/bulk/store', 'LoanController@storeBulkRepayment');
//route for tax
Route::group(['prefix' => 'trade_currency'], function () {
    Route::get('data', 'TradeCurrencyController@index');
    Route::get('create', 'TradeCurrencyController@create');
    Route::post('store', 'TradeCurrencyController@store');
    Route::get('{trade_currency}/edit', 'TradeCurrencyController@edit');
    Route::get('{trade_currency}/show', 'TradeCurrencyController@show');
    Route::post('{id}/update', 'TradeCurrencyController@update');
    Route::get('{id}/delete', 'TradeCurrencyController@delete');
});
//withdrawal methods
Route::group(['prefix' => 'withdrawal_method'], function () {
    Route::get('data', 'WithdrawalMethodController@index');
    Route::get('create', 'WithdrawalMethodController@create');
    Route::post('store', 'WithdrawalMethodController@store');
    Route::get('{withdrawal_method}/edit', 'WithdrawalMethodController@edit');
    Route::get('{withdrawal_method}/show', 'WithdrawalMethodController@show');
    Route::post('{id}/update', 'WithdrawalMethodController@update');
    Route::get('{id}/delete', 'WithdrawalMethodController@delete');
});

//withdrawal methods
Route::group(['prefix' => 'payment_gateway'], function () {
    Route::get('data', 'PaymentGatewayController@index');
    Route::get('create', 'PaymentGatewayController@create');
    Route::post('store', 'PaymentGatewayController@store');
    Route::get('{payment_gateway}/edit', 'PaymentGatewayController@edit');
    Route::get('{payment_gateway}/show', 'PaymentGatewayController@show');
    Route::post('{id}/update', 'PaymentGatewayController@update');
    Route::get('{id}/delete', 'PaymentGatewayController@delete');
});

//route for orders
Route::group(['prefix' => 'order'], function () {
    Route::get('data', 'OrderController@index');
    Route::get('{id}/cancel', 'OrderController@cancel');
    Route::get('{id}/done', 'OrderController@done');
    Route::get('{id}/pending', 'OrderController@pending');
    Route::get('{id}/delete', 'OrderController@delete');
});
//route for deposits
Route::group(['prefix' => 'deposit'], function () {
    Route::get('data', 'DepositController@index');
    Route::get('{id}/cancel', 'DepositController@cancel');
    Route::get('{id}/done', 'DepositController@done');
    Route::get('{id}/pending', 'DepositController@pending');
    Route::get('{id}/processing', 'DepositController@processing');
    Route::get('{id}/delete', 'DepositController@delete');

});
//route for withdrawals
Route::group(['prefix' => 'withdrawal'], function () {
    Route::get('data', 'WithdrawalController@index');
    Route::get('{id}/cancel', 'WithdrawalController@cancel');
    Route::get('{id}/done', 'WithdrawalController@done');
    Route::get('{id}/pending', 'WithdrawalController@pending');
    Route::get('{id}/processing', 'WithdrawalController@processing');
    Route::get('{id}/delete', 'WithdrawalController@delete');

});


Route::group(['prefix' => 'withdrawals'], function () {
    Route::get('data', 'WithdrawalController@withdrawal_index');
    Route::get('{id}/cancel', 'WithdrawalController@withdrawal_cancel');
    Route::get('{id}/done', 'WithdrawalController@withdrawal_done');
//
});

Route::get('treading/{id}',   'SettingController@democallnew');
Route::post('placeordersbuy', 'SettingController@placeorderbuy');
Route::post('placeordersell', 'SettingController@placeordersell');
Route::post('cancelorder',    'SettingController@cancelorder');


    Route::group(['prefix' => 'exchange'], function () {
    Route::get('buy', 'ExchangeController@buy');
    Route::get('sell', 'ExchangeController@sell');
    Route::get('balance', 'ExchangeController@mybalance');



    Route::post('call_order_middle', 'ExchangeController@call_order_middle');
    Route::post('call_order_full', 'ExchangeController@call_order_full');
    Route::post('order_full', 'ExchangeController@order_full');
    Route::post('order_middle', 'ExchangeController@order_middle');
    Route::get('order_middle1/{coin}', 'ExchangeController@order_middle_1');
    Route::get('order_full1/{coin}', 'ExchangeController@order_full_1');
    Route::get('order_full_block1/{coin}', 'ExchangeController@order_full_block_1');
    Route::get('buy_full_coin1/{coin}', 'ExchangeController@buy_full_coin_1');
    Route::get('sell_full_coin1/{coin}', 'ExchangeController@sell_full_coin_1');
    
    Route::get('buy_sell_data/{coin}', 'ExchangeController@buy_sell_data');
    Route::get('buy_sell_data1/{coin}', 'ExchangeController@buy_sell_data1');
    Route::get('get_status', 'ExchangeController@getstatus');


});

//route for bank accounts
Route::group(['prefix' => 'user_bank_account'], function () {
    Route::get('data', 'UserBankAccountController@index');
    Route::get('create', 'UserBankAccountController@create');
    Route::post('store', 'UserBankAccountController@store');
    Route::get('{user_bank_account}/show', 'UserBankAccountController@show');
    Route::get('{user_bank_account}/edit', 'UserBankAccountController@edit');
    Route::post('{id}/update', 'UserBankAccountController@update');
    Route::get('{id}/delete', 'UserBankAccountController@delete');

});


Route::group(['prefix' => 'wallets'], function () {
    
    Route::get('btc', 'WalletController@btcWallet');
    Route::get('eth', 'WalletController@ethWallet');
    Route::get('xrp', 'WalletController@xrpWallet');
    Route::get('ltc', 'WalletController@ltcWallet');
    Route::post('create_address', 'WalletController@walletsAddress');
    Route::post('show_address', 'WalletController@walletsShowAddress');
    Route::get('aed', 'WalletController@aed');
    Route::get('aed/withdraw', 'WalletController@withdraw_aed');
    Route::post('aed/withdraw/manual', 'WalletController@manual_withdraw_aed');
    Route::get('aed/deposit', 'WalletController@deposit_aed');
    Route::post('aed/deposit', 'WalletController@twocheckout');
    
    Route::get('btc/send', 'WalletController@sendBtc');
    Route::get('eth/send', 'WalletController@sendEth');
    Route::get('xrp/send', 'WalletController@sendXrp');
    Route::get('ltc/send', 'WalletController@sendLtc');

     Route::get('send/otp', 'WalletController@sendOtp');
     
    Route::post('send/btc', 'WalletController@btcSend');
    Route::post('send/eth', 'WalletController@ethSend');
    Route::post('send/xrp', 'WalletController@xrpSend');
    Route::post('send/ltc', 'WalletController@ltcSend');




});

//route for wallets
Route::group(['prefix' => 'wallet'], function () {

    // my(k) created Extra
    // Route::get('/', 'WalletController@index');
    // Route::post('/create_wallet', 'WalletController@create_wallet');
    // Route::get('/authenticate', 'WalletController@authenticate');
    // Route::post('/create_buy', 'BitfinexController@create_buy');
   
    Route::get('usd', 'WalletController@usd');
    Route::get('usd/deposit', 'WalletController@deposit_usd');
    Route::get('usd/withdraw', 'WalletController@withdraw_usd');
    Route::get('{id}/get_bank_accounts', 'WalletController@get_bank_accounts');
    Route::post('usd/withdraw/manual', 'WalletController@manual_withdraw_usd');
    Route::get('get_gateway_info', 'WalletController@get_gateway_info');
    Route::post('usd/deposit/stripe', 'WalletController@stripe_process');
    Route::post('usd/deposit/manual', 'WalletController@manual_deposit_usd');
    Route::get('usd/deposit/done', 'WalletController@deposit_done');
    Route::get('usd/deposit/paypal/ipn', 'WalletController@paypal_ipn');
    Route::post('{id}/update', 'WalletController@update');
    Route::get('btc', 'WalletController@btc');
    Route::get('btc/withdraw', 'WalletController@withdraw_btc');
    Route::post('btc/withdraw/manual', 'WalletController@manual_withdraw_btc');
    Route::get('deposit/{id}/cancel', 'WalletController@cancel_deposit');
    Route::get('withdrawal/{id}/cancel', 'WalletController@cancel_withdrawal');
    Route::get('ltc', 'WalletController@ltc');
    Route::get('ltc/withdraw', 'WalletController@withdraw_ltc');
    Route::post('ltc/withdraw/manual', 'WalletController@manual_withdraw_ltc');
    Route::get('dogecoin', 'WalletController@dogecoin');
    Route::get('dogecoin/withdraw', 'WalletController@withdraw_dogecoin');
    Route::post('dogecoin/withdraw/manual', 'WalletController@manual_withdraw_dogecoin');
    Route::get('generate_address', 'WalletController@generate_address');
    Route::get('eth', 'WalletController@eth');
    Route::get('eth/withdraw', 'WalletController@withdraw_eth');
    Route::post('eth/withdraw/manual', 'WalletController@manual_withdraw_eth');
    Route::get('xrp', 'WalletController@xrp');
    Route::get('xrp/withdraw', 'WalletController@withdraw_xrp');
    Route::post('xrp/withdraw/manual', 'WalletController@manual_withdraw_xrp');

});
//route for collateral
Route::group(['prefix' => 'history'], function () {
    Route::get('data', 'HistoryController@index');

});
//route for Buy/Sell
Route::group(['prefix' => 'trade'], function () {
    Route::get('data', 'SellBuyController@index');

});
//route for market
Route::group(['prefix' => 'market'], function () {
    Route::get('data', 'MarketController@index');
    Route::post('buy', 'MarketController@buy');
    Route::post('sell', 'MarketController@sell');
    Route::get('{id}/cancel', 'MarketController@cancel_order');
    Route::get('btcusd', 'MarketController@btcusd');
    Route::post('btcusd/buy', 'MarketController@buy_btc');
    Route::post('btcusd/sell', 'MarketController@sell_btc');
    Route::get('ltcusd', 'MarketController@ltcusd');
    Route::post('ltcusd/buy', 'MarketController@buy_ltc');
    Route::post('ltcusd/sell', 'MarketController@sell_ltc');
    Route::get('dogecoinusd', 'MarketController@dogecoinusd');
    Route::post('dogecoinusd/buy', 'MarketController@buy_dogecoin');
    Route::post('dogecoinusd/sell', 'MarketController@sell_dogecoin');
    Route::get('xrpusd', 'MarketController@xrpusd');
    Route::post('xrpusd/buy', 'MarketController@buy_xrp');
    Route::post('xrpusd/sell', 'MarketController@sell_xrp');
    Route::get('ethusd', 'MarketController@ethusd');
    Route::post('ethusd/buy', 'MarketController@buy_eth');
    Route::post('ethusd/sell', 'MarketController@sell_eth');
    //ajax refresh orders
    Route::get('refresh', 'MarketController@refresh');
    Route::get('latest_price', 'MarketController@latest_price');
    Route::get('graph', 'MarketController@graph');

});
//route for communication
Route::group(['prefix' => 'communication'], function () {
    Route::get('email', 'CommunicationController@indexEmail');
    Route::get('sms', 'CommunicationController@indexSms');
    Route::get('email/create', 'CommunicationController@createEmail');
    Route::post('email/store', 'CommunicationController@storeEmail');
    Route::get('email/{id}/delete', 'CommunicationController@deleteEmail');
    Route::get('sms/create', 'CommunicationController@createSms');
    Route::post('sms/store', 'CommunicationController@storeSms');
    Route::get('sms/{id}/delete', 'CommunicationController@deleteSms');

});

Route::get('audit_trail/data', 'AuditTrailController@index');

//routes for sms gateways
Route::group(['prefix' => 'sms_gateway'], function () {

    Route::get('data', 'SmsGatewayController@index');
    Route::get('create', 'SmsGatewayController@create');
    Route::post('store', 'SmsGatewayController@store');
    Route::get('{sms_gateway}/show', 'SmsGatewayController@show');
    Route::get('{sms_gateway}/edit', 'SmsGatewayController@edit');
    Route::post('{id}/update', 'SmsGatewayController@update');
    Route::get('{id}/delete', 'SmsGatewayController@delete');
});
//routes for offline wallets
Route::group(['prefix' => 'offline_wallet'], function () {

    Route::get('data', 'OfflineWalletController@index');
    Route::get('create', 'OfflineWalletController@create');
    Route::post('store', 'OfflineWalletController@store');
    Route::get('import/create', 'OfflineWalletController@create_import');
    Route::post('import/store', 'OfflineWalletController@store_import');
    Route::get('test_import', 'OfflineWalletController@test_import');
    Route::get('{offline_wallet}/show', 'OfflineWalletController@show');
    Route::get('{offline_wallet}/edit', 'OfflineWalletController@edit');
    Route::post('{id}/update', 'OfflineWalletController@update');
    Route::get('{id}/delete', 'OfflineWalletController@delete');
});
//routes for api
Route::group(['prefix' => 'api'], function () {
//v1
    Route::group(['prefix' => 'v1'], function () {
        Route::get('last_price', 'ApiController@last_price');
    });
});
Route::get('test', 'TestController@index');

Route::get('checkout', 'CheckoutController@index');

//Candle Stick Charts
Route::get('chart/{coin}/{cur}', 'MarketDataController@Chart');
Route::get('dashboard-exchange/chart/{coin}/{cur}', 'MarketDataController@Chart');
Route::get('testing', 'MarketDataController@Testing');
Route::get('update-market', 'MarketDataController@updateMarketData');
Route::get('get-market-data', 'MarketDataController@marketData');
Route::get('market-data/{coin}', 'MarketDataController@marketDataByCoin');


//Crate Buy Sell Demo by K
  Route::post('create_exg', 'ExgController@create_buy');



//bitgo callback for deposit
  Route::post('webhook', 'WalletController@webhookCallback');

Route::get('call', 'SettingController@mybalance');
Route::get('buycountshow/{type}/{id}', 'ExchangeController@buycountshow');
Route::get('treadehistory/{type}', 'ExchangeController@treadehistory');

Route::get('democall', 'SettingController@democall');



