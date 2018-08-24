<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;

use App\Models\CustomField;
use App\Models\CustomFieldMeta;
use App\Models\OrderBook;
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

class CheckoutController extends Controller
{
   
    public function index()
    {
        //echo "hmm Call";
          return view('checkout.index');
    }


}
