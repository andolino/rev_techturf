<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('rate_per_hr');
            $table->unsignedBigInteger('country_id');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('objective_title');
            $table->longText('objective_text');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}