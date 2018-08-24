<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;

use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\UserBankAccount;
use App\Models\Setting;
use App\Models\User;
use App\Models\WithdrawalMethod;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class UserBankAccountController extends Controller
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

        $data = UserBankAccount::where('user_id', Sentinel::getUser()->id)->get();

        return view('user_bank_account.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $withdrawal_methods = [];
        foreach (WithdrawalMethod::where('active', 1)->get() as $key) {
            $withdrawal_methods[$key->id] = $key->name;
        }
        return view('user_bank_account.create', compact('withdrawal_methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_bank_account = new UserBankAccount();
        $user_bank_account->user_id = Sentinel::getUser()->id;
        $user_bank_account->withdrawal_method_id = $request->withdrawal_method_id;
        $user_bank_account->default_account = $request->default_account;
        $user_bank_account->account_name = $request->account_name;
        $user_bank_account->bank_name = $request->bank_name;
        $user_bank_account->agency_number = $request->agency_number;
        $user_bank_account->account_number = $request->account_number;
        $user_bank_account->cpf_number = $request->cpf_number;
        $user_bank_account->notes = $request->notes;
        $user_bank_account->save();
        //check if there are other default accounts
        if ($request->default_account == 1) {
            foreach (UserBankAccount::where('default_account', 1)->where('user_id',
                Sentinel::getUser()->id)->where('id', '!=',$user_bank_account->id)->get() as $key)
            {
                $user_bank_account = UserBankAccount::find($key->id);
                $user_bank_account->default_account = 0;
                $user_bank_account->save();
            }
        }
        Flash::success(trans('general.successfully_saved'));
        return redirect('setting/data');
    }


    public function show($user_bank_account)
    {


        return view('user_bank_account.show', compact('user_bank_account'));
    }


    public function edit($user_bank_account)
    {
        $withdrawal_methods = [];
        foreach (WithdrawalMethod::where('active', 1)->get() as $key) {
            $withdrawal_methods[$key->id] = $key->name;
        }
        return view('user_bank_account.edit', compact('user_bank_account', 'withdrawal_methods'));
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

        $user_bank_account = UserBankAccount::find($id);
        if (Sentinel::getUser()->id != $user_bank_account->user_id) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        $user_bank_account->default_account = $request->default_account;
        $user_bank_account->withdrawal_method_id = $request->withdrawal_method_id;
        $user_bank_account->account_name = $request->account_name;
        $user_bank_account->agency_number = $request->agency_number;
        $user_bank_account->account_number = $request->account_number;
        $user_bank_account->cpf_number = $request->cpf_number;
        $user_bank_account->active = $request->active;
        $user_bank_account->notes = $request->notes;
        $user_bank_account->save();
        //check if there are other default accounts
        if ($request->default_account == 1) {
            foreach (UserBankAccount::where('default_account', 1)->where('user_id',
                Sentinel::getUser()->id)->where('id', '!=',
                $user_bank_account->id)->get() as $key) {
                $user_bank_account = UserBankAccount::find($key->id);
                $user_bank_account->default_account = 0;
                $user_bank_account->save();
            }
        }
        Flash::success(trans('general.successfully_saved'));
        return redirect('setting/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user_bank_account = UserBankAccount::find($id);
        if (!Sentinel::getUser()->id != $user_bank_account->user_id) {
            Flash::warning("Permission Denied");
            return redirect('/');
        }
        UserBankAccount::destroy($id);
        Flash::success(trans('general.successfully_deleted'));
        return redirect('setting/data');
    }

}
