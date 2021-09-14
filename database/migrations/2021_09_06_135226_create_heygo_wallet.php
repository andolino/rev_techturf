<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeygoWallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heygo_wallet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('students_payment_log_id');
            $table->double('amount', 8, 2);
            $table->timestamps();
            $table->foreign('students_payment_log_id')->references('id')->on('students_payment_log')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heygo_wallet');
    }
}
