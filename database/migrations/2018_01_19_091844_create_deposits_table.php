<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wallet_address_id')->nullable();
            $table->string('sender_address')->nullable();
            $table->string('receiver_address')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->text('transaction_id')->nullable();
            $table->integer('confirmations')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('trade_currency_id')->nullable();
            $table->integer('deposit_method_id')->nullable();
            $table->text('name')->nullable();
            $table->decimal('amount', 65, 30)->default(0.00);
            $table->decimal('fee', 65, 30)->default(0.00);
            $table->decimal('total', 65, 30)->default(0.00);
            $table->enum('status', ['pending', 'processing', 'cancelled', 'done', 'accepted'])->default('pending');
            $table->enum('network', ['usd','bitcoin','dogecoin','litecoin'])->default('usd');
            $table->enum('deposit_type', ['bank', 'manual', 'commission', 'system'])->default('bank');
            $table->text('notes')->nullable();
            $table->string('otp')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
