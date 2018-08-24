<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_book', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trade_currency_id')->nullable();
            $table->integer('from_currency_id')->nullable();
            $table->integer('to_currency_id')->nullable();
            $table->integer('linked_order_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->enum('order_type',['bid','ask']);
            $table->enum('market_type',['limit','market'])->default('limit');
            $table->decimal('amount', 65, 30)->nullable();
            $table->decimal('price', 65, 30)->nullable();
            $table->decimal('volume', 65, 30)->nullable();
            $table->decimal('fulfilled_volume', 65, 30)->nullable();
            $table->decimal('fee', 65, 30)->default(0.00);
            $table->enum('status',['pending','cancelled','done'])->nullable();
            $table->date('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('otp')->nullable();
            $table->timestamps();
            $table->index('id');
            $table->index('order_type');
            $table->enum('network', ['usd','bitcoin','dogecoin','litecoin'])->default('usd');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_book');
    }
}
