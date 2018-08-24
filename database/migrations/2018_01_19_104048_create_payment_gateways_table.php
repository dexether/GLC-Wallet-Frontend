<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('system')->default(0);
            $table->string('name')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('logo')->nullable();
            $table->text('paypal_email')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->string('stripe_publishable_key')->nullable();
            $table->string('paynow_key')->nullable();
            $table->string('paynow_id')->nullable();
            $table->string('perfect_money_alternate_phrase')->nullable();
            $table->string('perfect_money_account')->nullable();
            $table->enum('fee_method',['fixed','percentage','both'])->default('percentage');
            $table->decimal('fixed_fee', 65, 30)->default(0.00);
            $table->decimal('percentage_fee', 65, 30)->default(0.00);
            $table->decimal('minimum_amount', 65, 30)->default(0.00);
            $table->decimal('maximum_amount', 65, 30)->default(0.00);
            $table->text('notes')->nullable();
            $table->integer('confirmations')->default(3);
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('payment_gateways');
    }
}
