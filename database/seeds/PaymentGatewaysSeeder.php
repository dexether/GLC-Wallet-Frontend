<?php

use Illuminate\Database\Seeder;

class PaymentGatewaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('payment_gateways')->insert([
            [
                'system' => '1',
                'name' => 'Paypal',
                'notes' => 'Payment Via Paypal',

            ],
            [
                'system' => '1',
                'name' => 'Stripe',
                'notes' => 'Payment Via Stripe',

            ],
            [
                'system' => '1',
                'name' => 'Paynow',
                'notes' => 'Payment Via Paynow',

            ]
        ]);
    }
}
