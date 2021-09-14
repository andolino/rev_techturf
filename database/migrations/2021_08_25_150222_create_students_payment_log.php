<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsPaymentLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_payment_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_schedule_id');
            $table->dateTime('response_date');
            $table->tinyInteger('is_invalid')->default(0);
            $table->string('trans_id');
            $table->double('amount', 8, 2);
            $table->timestamps();
            $table->foreign('lesson_schedule_id')->references('id')->on('lesson_schedule')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_payment_log');
    }
}
