<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;

use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\WithdrawalMethod;
use App\Models\Setting;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class WithdrawalMethodController extends Controller
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
        if (!Sentinel::hasAccess('withdrawals')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = WithdrawalMethod::all();

        return view('withdrawal_method.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::hasAccess('withdrawals.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        return view('withdrawal_method.create', compact(''));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Sentinel::hasAccess('withdrawals.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $withdrawal_method = new WithdrawalMethod();
        $withdrawal_method->name = $request->name;
        /*$withdrawal_method->fee_method = $request->fee_method;
        $withdrawal_method->fixed_fee = $request->fixed_fee;
        $withdrawal_method->minimum_amount = $request->minimum_amount;
        $withdrawal_method->maximum_amount = $request->maximum_amount;
        $withdrawal_method->maximum_amount = $request->maximum_amount;*/
        $withdrawal_method->active = $request->active;
        $withdrawal_method->notes = $request->notes;
        if ($request->hasFile('logo')) {
            $file = array('logo' => Input::file('logo'));
            $rules = array('logo' => 'required|mimes:jpeg,jpg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                Flash::warning(trans('general.validation_error'));
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                $fname = "logo_" . uniqid() . '.' . $request->file('logo')->guessExtension();
                $withdrawal_method->logo = $fname;
                $request->file('logo')->move(public_path() . '/uploads',
                    $fname);
            }
        }
        $withdrawal_method->save();


        GeneralHelper::audit_trail("Added withdrawal method with id:" . $withdrawal_method->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('withdrawal_method/data');
    }


    public function show($withdrawal_method)
    {
        if (!Sentinel::hasAccess('withdrawals.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        return view('withdrawal_method.show', compact('withdrawal_method'));
    }


    public function edit($withdrawal_method)
    {
        if (!Sentinel::hasAccess('withdrawals.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        return view('withdrawal_method.edit', compact('withdrawal_method'));
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
        if (!Sentinel::hasAccess('withdrawals.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $withdrawal_method = WithdrawalMethod::find($id);
        $withdrawal_method->name = $request->name;
        /*$withdrawal_method->fee_method = $request->fee_method;
        $withdrawal_method->fixed_fee = $request->fixed_fee;
        $withdrawal_method->minimum_amount = $request->minimum_amount;
        $withdrawal_method->maximum_amount = $request->maximum_amount;
        $withdrawal_method->maximum_amount = $request->maximum_amount;*/
        $withdrawal_method->active = $request->active;
        $withdrawal_method->notes = $request->notes;
        if ($request->hasFile('logo')) {
            $file = array('logo' => Input::file('logo'));
            $rules = array('logo' => 'required|mimes:jpeg,jpg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                Flash::warning(trans('general.validation_error'));
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                $fname = "logo_" . uniqid() . '.' . $request->file('logo')->guessExtension();
                $withdrawal_method->logo = $fname;
                $request->file('logo')->move(public_path() . '/uploads',
                    $fname);
            }
        }
        $withdrawal_method->save();

        GeneralHelper::audit_trail("Updated withdrawal method with id:" . $withdrawal_method->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('withdrawal_method/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Sentinel::hasAccess('withdrawals.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        WithdrawalMethod::destroy($id);
        GeneralHelper::audit_trail("Deleted withdrawal method with id:" . $id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('withdrawal_method/data');
    }

}
