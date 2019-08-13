<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrackingPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tracking_id')->nullable();
            $table->string('date_of_payment')->nullable();
            $table->string('ordered_product')->nullable();
            $table->string('product_price')->nullable();
            $table->string('partial_payment')->nullable();
            $table->string('balance')->nullable();
            $table->string('payment_percent')->nullable();
            $table->string('remittance_details')->nullable();
            $table->string('upload_pic')->nullable();
            $table->string('remarks');
            $table->string('approve_pay')->default(0);
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
        Schema::dropIfExists('tracking_payments');
    }
}
