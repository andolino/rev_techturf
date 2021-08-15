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
            $table->unsignedBigInteger('students_level_id');
            $table->unsignedBigInteger('lesson_type_details_id');
            $table->unsignedBigInteger('students_test_preparation_id');
            $table->unsignedBigInteger('students_english_level_id');
            $table->string('test_prep_message')->nullable();
            $table->timestamps();
            $table->foreign('students_level_id')->references('id')->on('students_level')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('lesson_type_details_id')->references('id')->on('lesson_type_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('students_test_preparation_id')->references('id')->on('students_test_preparation')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('students_english_level_id')->references('id')->on('students_english_level')->onDelete('cascade')->onUpdate('cascade');
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
