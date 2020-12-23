<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPlatform extends Model
{
    protected $table = 'payment_platforms';

    protected $fillable = [
        'name', 'image'
    ];
}
