<?php

namespace App\Http\Controllers;

use Dotenv\Loader\Value;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $rules = [
           'value' => ['required','numeric','min:5'],
           'currency' => ['required', 'exists:currencies,iso'],
           'payment_platform' =>['required', 'exists:payment_platforms,id']
        ];

        $request->validate($rules);
        // var_dump($request);
        // die();
        return $request->all();
    }

}
