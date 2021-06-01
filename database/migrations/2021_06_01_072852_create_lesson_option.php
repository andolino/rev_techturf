<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_option', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_rate_id');
            $table->string('title');
            $table->integer('lesson_count');
            $table->decimal('cost', 12, 2);
            $table->timestamps();
            $table->foreign('currency_rate_id')->references('id')->on('currency_rate')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_option');
    }
}
