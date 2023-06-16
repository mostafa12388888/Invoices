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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('invoices_date');
            $table->date('due_date');
            $table->string('proudect');
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->decimal('amount_collection')->nullable();
            $table->decimal('amount_comission');
            $table->decimal('discount');
            $table->decimal('value_vate');
            // $table->string('section');
           
            $table->string('rate_vat');
           
            $table->decimal('total',8,2);
            $table->string('statues',50);
            $table->string('user');
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->date('paymetn_date')->nullable();
            
            

            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
};
