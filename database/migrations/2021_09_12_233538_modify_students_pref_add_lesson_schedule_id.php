<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStudentsPrefAddLessonScheduleId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students_pref', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_schedule_id')->nullable();
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
        //
    }
}
