@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Realizar un pago') }}</div>
                    <div class="card-body">
                        <form action="{{ route('payment.home') }}" method="POST" id="paymetForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="#">Cuando deseas pagar</label>
                                    <input type="numer" name="value" min="5" step="0.01" class="form-control"
                                        value="{{ mt_rand(500, 100000) / 100 }}">
                                    <samp class="form-text text-muted">Utilizar dos valores con decimal</samp>
                                </div>
                                <div class="col-md-4">
                                    <label for="#">Moneda de pago</label>
                                    <select name="currency" class="custom-select">
                                        @foreach ($currencies as $currency)
                                            <option value="{{ $currency->iso }}">
                                                {{ strtoupper($currency->iso) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label>Metodo de pago</label>
                                    <div class="form-group" id="toggler">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            @foreach ($paymentPlatforms as $paymentPlatform)
                                                <label class="btn btn-outline-secondary rounded m-2 p-1"
                                                    data-target="#{{ $paymentPlatform->name }}Collapse"
                                                    data-toggle="collapse">
                                                    <input type="radio" name="payment_platform"
                                                        value="{{ $paymentPlatform->id }}">
                                                    <img src="{{ asset($paymentPlatform->image) }}" alt="Payment"
                                                        class="img-thumbnail">
                                                </label>
                                            @endforeach
                                        </div>
                                        @foreach ($paymentPlatforms as $paymentPlatform)
                                            <div id="{{ $paymentPlatform->name }}Collapse" class="collapse"
                                                data-parent="#toggler">
                                                @includeIf('components.'. strtolower($paymentPlatform->name)
                                                . '-collapse')
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="far fa-credit-card"></i>
                                    Pagar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
