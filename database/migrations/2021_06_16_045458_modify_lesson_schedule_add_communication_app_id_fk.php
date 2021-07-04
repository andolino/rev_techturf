<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLessonScheduleAddCommunicationAppIdFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lesson_schedule', function (Blueprint $table) {
            $table->unsignedBigInteger('communication_app_id')->nullable();
            $table->string('app_id')->nullable();
            $table->foreign('communication_app_id')->references('id')->on('communication_app')->onDelete('cascade')->onUpdate('cascade');
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
