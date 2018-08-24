<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class SellBuyController extends Controller
{
	public function __construct()
    {
        $this->middleware(['sentinel','verify_requirements']);
    }
    public function index()
    {
    	return view('trade.data');
    }
}
