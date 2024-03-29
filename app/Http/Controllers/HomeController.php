<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use App\PaymentPlatform;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currencies = Currency::select('iso')->get();
        $paymentPlatforms = PaymentPlatform::select('id', 'name', 'image')->get();
        return view('home', compact('currencies', 'paymentPlatforms'));
    }
}
