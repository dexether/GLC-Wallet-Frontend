<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;


use App\Models\TradeCurrency;
use App\Models\Setting;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class TradeCurrencyController extends Controller
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
        if (!Sentinel::hasAccess('currencies')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = TradeCurrency::all();
        return view('trade_currency.data', compact('data'));
    }


    public function show($trade_currency)
    {
        if (!Sentinel::hasAccess('currencies.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        return view('trade_currency.show', compact('trade_currency'));
    }


    public function edit($trade_currency)
    {
        if (!Sentinel::hasAccess('currencies.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        return view('trade_currency.edit', compact('trade_currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Sentinel::hasAccess('currencies.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $trade_currency = TradeCurrency::find($id);
        $trade_currency->name = $request->name;
        $trade_currency->xml_code = $request->xml_code;
        $trade_currency->notes = $request->notes;
        $trade_currency->decimals = $request->decimals;
        if ($trade_currency->cryptocurrency == 1) {
            $trade_currency->api_key = $request->api_key;
            $trade_currency->address = $request->address;
        }
        $trade_currency->fee_method = $request->fee_method;
        $trade_currency->deposit_fixed_fee = $request->deposit_fixed_fee;
        $trade_currency->deposit_percentage_fee = $request->deposit_percentage_fee;
        $trade_currency->withdrawal_fixed_fee = $request->withdrawal_fixed_fee;
        $trade_currency->withdrawal_percentage_fee = $request->withdrawal_percentage_fee;
        $trade_currency->trade_fixed_fee = $request->trade_fixed_fee;
        $trade_currency->trade_percentage_fee = $request->trade_percentage_fee;
        $trade_currency->minimum_amount = $request->minimum_amount;
        $trade_currency->maximum_amount = $request->maximum_amount;
        $trade_currency->commission_fixed_fee = $request->commission_fixed_fee;
        $trade_currency->commission_percentage_fee = $request->commission_percentage_fee;
        $trade_currency->allow_commission = $request->allow_commission;
        $trade_currency->allow_receiving = $request->allow_receiving;
        $trade_currency->allow_sending = $request->allow_sending;
        $trade_currency->allow_withdrawal = $request->allow_withdrawal;
        $trade_currency->active = $request->active;


        if ($request->hasFile('logo')) {
            $file = array('logo' => Input::file('logo'));
            $rules = array('logo' => 'required|mimes:jpeg,jpg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                Flash::warning(trans('general.validation_error'));
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                $fname = "logo_" . uniqid() . '.' . $request->file('logo')->guessExtension();
                $trade_currency->logo = $fname;
                $request->file('logo')->move(public_path() . '/uploads',
                    $fname);
            }
        }
        $trade_currency->save();
        GeneralHelper::audit_trail("Updated trade currency with id:" . $trade_currency->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('trade_currency/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


}
