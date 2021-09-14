<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyLessonScheduleStatusDefaultTo1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `lesson_schedule` 
                        CHANGE `status` `status` tinyint(4) 
                        DEFAULT 1 
                        COMMENT '1 => open, 0 => cancel, 2 => re-schedule. Please check new_lesson_schedule_id field for new schedule, 3 = confirmed';");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('1', function (Blueprint $table) {
            //
        });
    }
}
