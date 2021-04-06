<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonPlanRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_plan_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_plan_id');
            $table->unsignedBigInteger('rated_teachers_id');
            $table->tinyInteger('rate')->default(0)->comment('1 - 5 star, 5 is highest');
            $table->timestamps();
            $table->foreign('lesson_plan_id')->references('id')->on('lesson_plan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rated_teachers_id')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_plan_ratings');
    }
}
