<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('default_currency')->default(0);
            $table->integer('user_id')->nullable();
            $table->integer('confirmations')->default(3)->nullable();
            $table->string('name')->nullable();
            $table->enum('fee_method', ['fixed', 'percentage', 'both'])->default('percentage');
            $table->decimal('deposit_fixed_fee', 65, 30)->default(0.00);
            $table->decimal('withdrawal_fixed_fee', 65, 30)->default(0.00);
            $table->decimal('deposit_percentage_fee', 65, 30)->default(0.00);
            $table->decimal('withdrawal_percentage_fee', 65, 30)->default(0.00);
            $table->decimal('trade_percentage_fee', 65, 30)->default(0.00);
            $table->decimal('trade_fixed_fee', 65, 30)->default(0.00);
            $table->decimal('minimum_amount', 65, 30)->default(0.00);
            $table->decimal('maximum_amount', 65, 30)->default(0.00);
            $table->decimal('commission_fixed_fee', 65, 30)->default(0.00);
            $table->decimal('commission_percentage_fee', 65, 30)->default(0.00);
            $table->tinyInteger('allow_commission')->default(1);
            $table->tinyInteger('allow_receiving')->default(1);
            $table->tinyInteger('allow_sending')->default(1);
            $table->tinyInteger('allow_withdrawal')->default(1);
            $table->tinyInteger('cryptocurrency')->default(1);
            $table->string('api_key')->nullable();
            $table->string('network')->nullable();
            $table->string('address')->nullable();
            $table->string('secret_pin')->nullable();
            $table->string('xml_code')->nullable();
            $table->string('site_code')->nullable();
            $table->text('logo')->nullable();
            $table->integer('decimals')->default(4);
            $table->tinyInteger('active')->default(1);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('trade_currencies');
    }
}
