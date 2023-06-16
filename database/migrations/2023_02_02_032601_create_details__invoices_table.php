<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details__invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Invoice');
            $table->string('invoice_number');
            $table->foreign('id_Invoice')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('product');
            $table->string('section');
            $table->string('status');
            $table->integer('value_status');
            $table->date('payment_date')->nullable();

            $table->text('note')->nullable();
            $table->string('user');
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
        Schema::dropIfExists('details__invoices');
    }
};
