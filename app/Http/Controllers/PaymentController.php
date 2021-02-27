<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Services\PayPalService;
use App\Resolvers\PaymentPlatformResolver;


class PaymentController extends Controller
{
    protected $paymentPlatformResolver;

    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth');

        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }

    public function pay(Request $request)
    {
        $rules = [
            'value' => ['required', 'numeric', 'min:5'],
            'currency' => ['required', 'exists:currencies,iso'],
            'payment_platform' => ['required', 'exists:payment_platforms,id']
        ];

        $request->validate($rules);
        // dd($request->all());
        // $paymentPlatform = resolve(PayPalService::class);
        $paymentPlatform = $this->paymentPlatformResolver
        ->resolveService($request->payment_platform);

        session()->put('paymentPlatformId', $request->payment_platform);


        return $paymentPlatform->handlePayment($request);
    }

    public function approval()
    {
        // $paymentPlatform = resolve(PayPalService::class);
        if (session()->has('paymentPlatformId')) {
            $paymentPlatform = $this->paymentPlatformResolver
                ->resolveService(session()->get('paymentPlatformId'));

            return $paymentPlatform->handleApproval();
        }
    }

    public function cancelled()
    {

        return redirect()->route('home')->withErrors('Has cancelado tu pago');
    }
}
