<?php

namespace App\Http\Controllers;

use App\Events\WithdrawalComplete;
use App\Helpers\GeneralHelper;

use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\Withdrawal;
use App\Models\Setting;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use App\Models\WalletAddress;



class WithdrawalController extends Controller
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
        $data = Withdrawal::all();

        return view('withdrawal.data', compact('data'));
    }

    public function pending($id)
    {
        if (!Sentinel::hasAccess('withdrawals.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $withdrawal = Withdrawal::find($id);
        $withdrawal->status = "pending";
        $withdrawal->save();
        GeneralHelper::audit_trail("Updated withdrawal with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('withdrawal/data');

    }

    public function cancel($id)
    {
        if (!Sentinel::hasAccess('withdrawals.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $withdrawal = Withdrawal::find($id);
        $withdrawal->status = "cancelled";
        $withdrawal->save();



//        GeneralHelper::audit_trail("Updated withdrawal with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('withdrawal/data');

    }
    public function processing($id)
    {
        if (!Sentinel::hasAccess('withdrawals.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $withdrawal = Withdrawal::find($id);
        $withdrawal->status = "processing";
        $withdrawal->save();
        GeneralHelper::audit_trail("Updated withdrawal with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('withdrawal/data');

    }
    public function done($id)
    {
        if (!Sentinel::hasAccess('withdrawals.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $withdrawal = Withdrawal::find($id);
        $withdrawal->status = "done";
        $withdrawal->save();

        event(new WithdrawalComplete($withdrawal));
        GeneralHelper::audit_trail("Updated withdrawal with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('withdrawal/data');

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

        $coin="";
        if($withdrawal->trade_currency_id == 1)
            $coin ='ETH';
        else if($withdrawal->trade_currency_id == 2)
            $coin ='XRP';
        else if($withdrawal->trade_currency_id == 3)
            $coin ='AED';
        else if($withdrawal->trade_currency_id == 4)
            $coin ='BTC';
        else if($withdrawal->trade_currency_id == 5)
            $coin ='LTC';

        $walletaddress = WalletAddress::where('user_id',$withdrawal->user_id)->where('coin',$coin)->first();
        $walletaddress->balance = $walletaddress->balance + $withdrawal->amount;
        $walletaddress->save();




        Withdrawal::destroy($id);

        GeneralHelper::audit_trail("Deleted withdrawal with id:" . $id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('withdrawal/data');

    }


    public function withdrawal_index()
    {
        if (!Sentinel::hasAccess('withdrawals')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
         $data = Withdrawal::all();

        return view('withdrawals.data', compact('data'));
    }



    public function withdrawal_cancel($id)
    {
        if (!Sentinel::hasAccess('withdrawals.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $withdrawal = Withdrawal::find($id);
        $withdrawal->status = "cancelled";
        $withdrawal->save();

        $coin="";
        if($withdrawal->trade_currency_id == 1)
            $coin ='ETH';
        else if($withdrawal->trade_currency_id == 2)
            $coin ='XRP';
        else if($withdrawal->trade_currency_id == 3)
            $coin ='AED';
        else if($withdrawal->trade_currency_id == 4)
            $coin ='BTC';
        else if($withdrawal->trade_currency_id == 5)
            $coin ='LTC';

        /*$walletaddress = WalletAddress::where('user_id',$withdrawal->user_id)->where('coin',$coin)->first();
        $walletaddress->balance = $walletaddress->balance + $withdrawal->total;
        $walletaddress->save();*/

        $user =User::find($withdrawal->user_id);
        $user->aed_balance = $user->aed_balance+ $withdrawal->total;
        $user->save();


        GeneralHelper::audit_trail("Updated withdrawal with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('withdrawals/data');

    }

    public function withdrawal_done($id)
    {
        if (!Sentinel::hasAccess('withdrawals.delete')) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $withdrawal = Withdrawal::find($id);
        $withdrawal->status = "done";
        $withdrawal->save();

        event(new WithdrawalComplete($withdrawal));
        GeneralHelper::audit_trail("Updated withdrawal with id:" . $id);
        Flash::success(trans('general.successfully_saved'));
        return redirect('withdrawals/data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    

}
