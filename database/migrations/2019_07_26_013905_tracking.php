<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('ordered_product')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('total_price');
            $table->string('balance');
            $table->string('pre_balance')->nullable();
            $table->string('payment_percent');
            $table->rememberToken();
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
        Schema::dropIfExists('tracking');
    }
}
