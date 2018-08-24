<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderFulfilmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_fulfilments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_currency_id')->nullable();
            $table->integer('to_currency_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('linked_order_id')->nullable();
            $table->decimal('amount', 65, 30)->nullable();
            $table->decimal('price', 65, 30)->nullable();
            $table->decimal('volume', 65, 30)->nullable();
            $table->date('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_fulfilments');
    }
}
