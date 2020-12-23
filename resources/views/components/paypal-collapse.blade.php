<small>Seras redireccinada a la pagina oficial de PayPal</small>

<div class="col-md-6 mt-4">
    <label for="#">Metodo de pago</label>
    <div class="form-group" id="toggler">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            @foreach ($paymentPlatforms as $paymentPlatform)
                <label for="#" class="btn btn-outline-secondary rounded m-2 p-1"
                    data-target="#{{ $paymentPlatform->name }}Collapse"
                    data-toggle="collapse">
                    <input type="radio" name="payment_platform"
                        value="{{ $paymentPlatform->id }}""
                        required>
                    <img src=" {{ asset($paymentPlatform->image) }}" alt="Payment"
                        class="img-thumbnail">

                </label>
            @endforeach
        </div>
        @foreach ($paymentPlatforms as $paymentPlatform)
            <div id="{{ $paymentPlatform->name }}Collapse" class="collapse"
                data-parent="#toggler">
                @includeIf('components'. strtolower($paymentPlatform)
                . '-collapse')
            </div>
        @endforeach
    </div>
</div>