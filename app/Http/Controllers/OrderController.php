<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;

use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\OrderBook;
use App\Models\Setting;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class OrderController extends Controller
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
        if (!Sentinel::hasAccess('other_income')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $data = OrderBook::all();

        return view('order.data', compact('data'));
    }

    public function pending($id)
    {
        if (!Sentinel::hasAccess('other_income.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $order = OrderBook::find($id);
        $order->status = "pending";
        $order->save();
        GeneralHelper::audit_trail("Updated order with id:" . $id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('order/data');

    }

    public function cancel($id)
    {
        if (!Sentinel::hasAccess('other_income.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $order = OrderBook::find($id);
        $order->status = "cancelled";
        $order->save();
        GeneralHelper::audit_trail("Updated order with id:" . $id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('order/data');

    }

    public function done($id)
    {
        if (!Sentinel::hasAccess('other_income.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $order = OrderBook::find($id);
        $order->status = "done";
        $order->save();
        GeneralHelper::audit_trail("Updated order with id:" . $id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('order/data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (!Sentinel::hasAccess('other_income.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        OrderBook::destroy($id);
        GeneralHelper::audit_trail("Deleted order with id:" . $id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('order/data');

    }

}
