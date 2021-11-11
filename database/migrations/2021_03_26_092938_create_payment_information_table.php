<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->bigInteger('invoice_id');
            $table->string('name');
            $table->bigInteger('phone');
            $table->string('invoice');
            $table->string('bank_transfer_from');
            $table->string('bank_transfer_to');
            $table->string('from_name');
            $table->bigInteger('total');
            $table->date('transfer_date');
            $table->string('image');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('payment_information');
    }
}
