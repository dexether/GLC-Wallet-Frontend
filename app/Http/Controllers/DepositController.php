<?php

namespace App\Http\Controllers;

use App\Events\DepositReceived;
use App\Helpers\GeneralHelper;

use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\Deposit;
use App\Models\Setting;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class DepositController extends Controller
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
        $data = Deposit::all();


        return view('deposit.data', compact('data'));
    }

    public function pending($id)
    {
        if (!Sentinel::hasAccess('deposits.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $deposit = Deposit::find($id);
        $deposit->status = "pending";
        $deposit->save();
        GeneralHelper::audit_trail("Updated deposit with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('deposit/data');

    }

    public function cancel($id)
    {
        if (!Sentinel::hasAccess('deposits.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $deposit = Deposit::find($id);
        $deposit->status = "cancelled";
        $deposit->save();
        GeneralHelper::audit_trail("Updated deposit with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('deposit/data');

    }
    public function processing($id)
    {
        if (!Sentinel::hasAccess('deposits.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $deposit = Deposit::find($id);
        $deposit->status = "processing";
        $deposit->save();
        GeneralHelper::audit_trail("Updated deposit with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('deposit/data');

    }
    public function done($id)
    {
        if (!Sentinel::hasAccess('deposits.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $deposit = Deposit::find($id);
        $deposit->status = "done";
        $deposit->save();
        event(new DepositReceived($deposit));
        GeneralHelper::audit_trail("Updated deposit with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('deposit/data');

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
        Deposit::destroy($id);
        GeneralHelper::audit_trail("Deleted deposit with id:" . $id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('deposit/data');

    }

    

}
