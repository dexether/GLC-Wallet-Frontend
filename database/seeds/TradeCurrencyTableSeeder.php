<?php

use Illuminate\Database\Seeder;

class TradeCurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('trade_currencies')->insert([
            [
                'default_currency' => '1',
                'cryptocurrency' => '0',
                'name' => 'USD',
                'api_key' => '',
                'network' => '',
                'xml_code' => 'USD',

            ],
            [
                'default_currency' => '0',
                'cryptocurrency' => '1',
                'name' => 'Bitcoin',
                'api_key' => '',
                'network' => 'bitcoin',
                'xml_code' => 'BTC',

            ],
            [
                'default_currency' => '0',
                'cryptocurrency' => '1',
                'name' => 'Litecoin',
                'api_key' => '',
                'network' => 'litecoin',
                'xml_code' => 'LTC',

            ],
            [
                'default_currency' => '0',
                'cryptocurrency' => '1',
                'name' => 'Dogecoin',
                'api_key' => '',
                'network' => 'dogecoin',
                'xml_code' => 'DOGE',

            ]
        ]);
    }
}
