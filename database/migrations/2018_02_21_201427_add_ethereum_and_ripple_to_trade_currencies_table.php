<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEthereumAndRippleToTradeCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE withdrawals CHANGE COLUMN network network ENUM('usd', 'bitcoin','litecoin','dogecoin','ethereum','ripple') DEFAULT 'usd'");
        DB::statement("ALTER TABLE deposits CHANGE COLUMN network network ENUM('usd', 'bitcoin','litecoin','dogecoin','ethereum','ripple') DEFAULT 'usd'");
        DB::statement("ALTER TABLE order_book CHANGE COLUMN network network ENUM('usd', 'bitcoin','litecoin','dogecoin','ethereum','ripple') DEFAULT 'usd'");
        \Illuminate\Support\Facades\DB::table('trade_currencies')->insert([
            [

                'name' => 'Ethereum',
                'network' => 'ethereum',
                'xml_code' => 'ETH',
            ],
            [

                'name' => 'Ripple',
                'network' => 'ripple',
                'xml_code' => 'XRP',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App\Models\TradeCurrency::where('network', 'ethereum')
            ->delete();
        App\Models\TradeCurrency::where('network', 'ripple')
            ->delete();
    }
}
