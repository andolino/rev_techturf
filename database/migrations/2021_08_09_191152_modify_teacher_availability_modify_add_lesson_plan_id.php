<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTeacherAvailabilityModifyAddLessonPlanId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_availability', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_plan_id')->nullable();
            $table->foreign('lesson_plan_id')->references('id')->on('lesson_plan')->onDelete('cascade')->onUpdate('cascade');
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
