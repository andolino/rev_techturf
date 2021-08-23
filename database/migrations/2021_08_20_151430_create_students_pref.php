<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsPref extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_pref', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('students_id');
            $table->unsignedBigInteger('students_level_id');
            $table->string('lesson_type_details_id');
            $table->unsignedBigInteger('students_test_preparation_id')->nullable();
            $table->string('test_prep_message')->nullable();
            $table->unsignedBigInteger('students_english_level_id');
            $table->unsignedBigInteger('students_date_plan_id');
            $table->timestamps();
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('students_level_id')->references('id')->on('students_level')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('students_test_preparation_id')->references('id')->on('students_test_preparation')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('students_date_plan_id')->references('id')->on('students_date_plan')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_pref');
    }
}
