<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriledgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triledgers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date', 255);
            $table->string('time', 255);                      
            $table->longText('comment');
            $table->integer('amount');
            $table->string('transaction_type', 255);           
            $table->string('payment_method', 255);           
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
        Schema::dropIfExists('triledgers');
    }
}
