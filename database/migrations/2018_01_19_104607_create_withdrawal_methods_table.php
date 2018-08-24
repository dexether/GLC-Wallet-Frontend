<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawalMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('system')->default(0);
            $table->string('name')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('logo')->nullable();
            $table->enum('fee_method',['fixed','percentage','both'])->default('percentage');
            $table->decimal('fixed_fee', 65, 30)->default(0.00);
            $table->decimal('percentage_fee', 65, 30)->default(0.00);
            $table->decimal('minimum_amount', 65, 30)->default(0.00);
            $table->decimal('maximum_amount', 65, 30)->default(0.00);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('withdrawal_methods');
    }
}
