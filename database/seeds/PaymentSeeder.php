<?php

use App\PaymentPlatform;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        PaymentPlatform::create([
            'name' => 'PayPal',
            'image' => 'img/paypal.jpg'

        ]);

        PaymentPlatform::create([
            'name' => 'Stripe',
            'image' => 'img/stripe.jpg'

        ]);
    }
}
