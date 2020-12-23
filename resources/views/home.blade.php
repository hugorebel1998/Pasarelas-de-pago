@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Realizar un pago') }}</div>
                    <div class="card-body">
                        <form action="#" method="POST" id="paymetForm">
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
