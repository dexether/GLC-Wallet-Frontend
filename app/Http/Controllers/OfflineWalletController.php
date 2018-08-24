<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;


use App\Models\OfflineWallet;
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
use Maatwebsite\Excel\Facades\Excel;

class OfflineWalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('sentinel','verify_requirements');
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
        $data = OfflineWallet::all();

        return view('offline_wallet.data', compact('data'));
    }

    public function create()
    {
        if (!Sentinel::hasAccess('currencies')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $trade_currencies = [];
        foreach (TradeCurrency::where('default_currency', 0)->get() as $key) {
            $trade_currencies[$key->id] = $key->name;
        }
        return view('offline_wallet.create', compact('trade_currencies'));
    }

    public function store(Request $request)
    {
        if (!Sentinel::hasAccess('currencies.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $offline_wallet = new OfflineWallet();
        $offline_wallet->address = $request->address;
        $offline_wallet->trade_currency_id = $request->trade_currency_id;
        $offline_wallet->active = $request->active;
        $offline_wallet->save();
        GeneralHelper::audit_trail("Added offline wallet with id:" . $offline_wallet->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('offline_wallet/data');
    }

    public function create_import()
    {
        if (!Sentinel::hasAccess('currencies')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $trade_currencies = [];
        foreach (TradeCurrency::where('default_currency', 0)->get() as $key) {
            $trade_currencies[$key->id] = $key->name;
        }
        return view('offline_wallet.import', compact('trade_currencies'));
    }

    public function test_import()
    {
        if (!Sentinel::hasAccess('currencies')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        Excel::filter('chunk')->load(public_path('uploads/sample.xlsx'))->chunk(250,
            function ($results) {
                foreach ($results as $row) {
                    // do stuff
                    echo $row->address . "<br>";
                }
            });
    }

    public function store_import(Request $request)
    {
        if (!Sentinel::hasAccess('currencies.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        if ($request->hasFile('file')) {
            $file = array('file' => $request->file('file'));
            $rules = array('file' => 'required|mimes:xlsx,csv');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                Flash::warning(trans('general.validation_error'));
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                $temporary_name = uniqid() . '.' . $request->file('file')->guessExtension();
                $request->file('file')->move(public_path() . '/uploads', $temporary_name);
                $trade_currency_id = $request->trade_currency_id;
                $active = $request->active;
                Excel::filter('chunk')->load(public_path('uploads/' . $temporary_name))->chunk(250,
                    function ($results) use ($trade_currency_id, $active) {
                        foreach ($results as $row) {
                            if (!empty($row->address) && OfflineWallet::where('address', $row->address)->count() == 0) {
                                $offline_wallet = new OfflineWallet();
                                $offline_wallet->address = $row->address;
                                $offline_wallet->trade_currency_id = $trade_currency_id;
                                $offline_wallet->active = $active;
                                $offline_wallet->save();
                            }
                        }
                    });
                @unlink(public_path('uploads/' . $temporary_name));
                Flash::success(trans('general.successfully_saved'));
                return redirect('offline_wallet/data');
            }
        }
        Flash::success(trans('general.successfully_saved'));
        return redirect('offline_wallet/data');
    }

    public function show($offline_wallet)
    {
        if (!Sentinel::hasAccess('currencies.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        return view('offline_wallet.show', compact('offline_wallet'));
    }


    public function edit($offline_wallet)
    {
        if (!Sentinel::hasAccess('currencies.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $trade_currencies = [];
        foreach (TradeCurrency::where('default_currency', 0)->get() as $key) {
            $trade_currencies[$key->id] = $key->name;
        }
        return view('offline_wallet.edit', compact('offline_wallet', 'trade_currencies'));
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
        $offline_wallet = OfflineWallet::find($id);
        $offline_wallet->address = $request->address;
        $offline_wallet->trade_currency_id = $request->trade_currency_id;
        $offline_wallet->active = $request->active;
        $offline_wallet->save();
        GeneralHelper::audit_trail("Updated offline wallet with id:" . $offline_wallet->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('offline_wallet/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        OfflineWallet::destroy($id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('offline_wallet/data');
    }

}
