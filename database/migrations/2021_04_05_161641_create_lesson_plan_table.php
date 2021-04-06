<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_plan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teachers_id');
            $table->unsignedBigInteger('type_of_lesson_id');
            $table->string('title');
            $table->longText('body');
            $table->tinyInteger('is_closed')->default(1)->comment('0 => Closed, 1 => Open');
            $table->timestamps();
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_of_lesson_id')->references('id')->on('type_of_lesson')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_plan');
    }
}
