<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('trade_currency_id')->nullable();
            $table->integer('reference')->nullable();
            $table->enum('type', ['deposit', 'withdrawal'])->default('deposit');
            $table->text('transaction_id')->nullable();
            $table->decimal('amount', 65, 30)->default(0.00);
            $table->decimal('fee', 65, 30)->default(0.00);
            $table->decimal('total', 65, 30)->default(0.00);
            $table->timestamps();
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade_history');
    }
}
