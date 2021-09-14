<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter', function (Blueprint $table) {
            $table->id();
            $table->string('counter_for', 100);
            $table->string('counter_code', 100);
            $table->integer('current_value')->default(0);
            $table->integer('counter_length')->default(0);
            $table->string('prefix', 10);
            $table->string('suffix', 10);
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
        Schema::dropIfExists('counter');
    }
}
