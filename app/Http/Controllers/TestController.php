<?php

namespace App\Http\Controllers;

use Aloha\Twilio\Twilio;
use App\Helpers\GeneralHelper;
use App\Helpers\Infobip;
use App\Helpers\RouteSms;
use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\Deposit;
use App\Models\Email;
use App\Models\Expense;
use App\Models\Loan;
use App\Models\LoanOverduePenalty;
use App\Models\LoanRepayment;
use App\Models\LoanSchedule;
use App\Models\OrderBook;
use App\Models\Payroll;
use App\Models\PayrollMeta;
use App\Models\PayrollTemplateMeta;
use App\Models\Saving;
use App\Models\SavingProduct;
use App\Models\SavingTransaction;
use App\Models\Setting;
use App\Models\Sms;
use App\Models\TradeCurrency;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Clickatell\Rest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use PDF;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use App\Http\Requests;

class TestController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $res = $client->request('GET',
            'https://api.ethplorer.io/getAddressTransactions/0xe060ea1402e5713c5E140054B1e1c253137E4636?apiKey=freekey');
        echo $res->getBody();


    }

}
