<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;

use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\PaymentGateway;
use App\Models\Setting;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class PaymentGatewayController extends Controller
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
        if (!Sentinel::hasAccess('deposits')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = PaymentGateway::all();

        return view('payment_gateway.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Sentinel::hasAccess('deposits.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        return view('payment_gateway.create', compact(''));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Sentinel::hasAccess('deposits.create')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $payment_gateway = new PaymentGateway();
        $payment_gateway->name = $request->name;
        /*$payment_gateway->fee_method = $request->fee_method;
        $payment_gateway->fixed_fee = $request->fixed_fee;
        $payment_gateway->minimum_amount = $request->minimum_amount;
        $payment_gateway->maximum_amount = $request->maximum_amount;
        $payment_gateway->maximum_amount = $request->maximum_amount;*/
        $payment_gateway->active = $request->active;
        $payment_gateway->notes = $request->notes;
        if ($request->hasFile('logo')) {
            $file = array('logo' => Input::file('logo'));
            $rules = array('logo' => 'required|mimes:jpeg,jpg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                Flash::warning(trans('general.validation_error'));
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                $fname = "logo_" . uniqid() . '.' . $request->file('logo')->guessExtension();
                $payment_gateway->logo = $fname;
                $request->file('logo')->move(public_path() . '/uploads',
                    $fname);
            }
        }
        $payment_gateway->save();


        GeneralHelper::audit_trail("Added withdrawal method with id:" . $payment_gateway->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('payment_gateway/data');
    }


    public function show($payment_gateway)
    {
        if (!Sentinel::hasAccess('deposits.view')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        return view('payment_gateway.show', compact('payment_gateway'));
    }


    public function edit($payment_gateway)
    {
        if (!Sentinel::hasAccess('deposits.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }

        return view('payment_gateway.edit', compact('payment_gateway'));
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

        if (!Sentinel::hasAccess('deposits.update')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $payment_gateway = PaymentGateway::find($id);
        if ($payment_gateway->system == 1) {
            if ($payment_gateway->name == "Paypal") {
                $payment_gateway->paypal_email = $request->paypal_email;
            }
            if ($payment_gateway->name == "Paynow") {
                $payment_gateway->paynow_key = $request->paynow_key;
                $payment_gateway->paynow_id = $request->paynow_id;
            }
            if ($payment_gateway->name == "Stripe") {
                $payment_gateway->stripe_secret_key = $request->stripe_secret_key;
                $payment_gateway->stripe_publishable_key = $request->stripe_publishable_key;
            }
            if ($payment_gateway->name == "2checkout") {
                $payment_gateway->stripe_secret_key = $request->secret_key;
                $payment_gateway->stripe_publishable_key = $request->publishable_key;
                $payment_gateway->supplier_id = $request->supplier_id;
            }
        } else {
            $payment_gateway->name = $request->name;
        }
        /*$payment_gateway->fee_method = $request->fee_method;
        $payment_gateway->fixed_fee = $request->fixed_fee;
        $payment_gateway->minimum_amount = $request->minimum_amount;
        $payment_gateway->maximum_amount = $request->maximum_amount;
        $payment_gateway->maximum_amount = $request->maximum_amount;*/
//        $payment_gateway->active = $request->active;
        $payment_gateway->notes = $request->notes;
        $payment_gateway->type = $request->type;
        if ($request->hasFile('logo')) {
            $file = array('logo' => Input::file('logo'));
            $rules = array('logo' => 'required|mimes:jpeg,jpg,bmp,png');
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
                Flash::warning(trans('general.validation_error'));
                return redirect()->back()->withInput()->withErrors($validator);
            } else {
                $fname = "logo_" . uniqid() . '.' . $request->file('logo')->guessExtension();
                $payment_gateway->logo = $fname;
                $request->file('logo')->move(public_path() . '/uploads',
                    $fname);
            }
        }
        $payment_gateway->save();

//        if($request->active == 1)
//        {
//            PaymentGateway::where('id','!=',$id)->update(["active"=>0]);
//        }




        GeneralHelper::audit_trail("Updated withdrawal method with id:" . $payment_gateway->id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('payment_gateway/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Sentinel::hasAccess('deposits.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $payment_gateway = PaymentGateway::find($id);
        if ($payment_gateway->system == 1) {
            Flash::warning("You cannot delete system gateway. Disable it instead");
            return redirect()->back();
        } else {
            PaymentGateway::destroy($id);
            GeneralHelper::audit_trail("Deleted payment gateway with id:" . $id);
            Flash::success(trans('general.successfully_deleted'));
            return redirect('payment_gateway/data');
        }

    }

}
