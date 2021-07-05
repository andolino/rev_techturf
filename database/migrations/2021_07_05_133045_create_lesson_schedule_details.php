<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonScheduleDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_schedule_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_schedule_id');
            $table->dateTime('lesson_date');
            $table->foreign('lesson_schedule_id')->references('id')->on('lesson_schedule')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('lesson_schedule_details');
    }
}
