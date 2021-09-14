<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStudentsPaymentLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `students_payment_log` ADD COLUMN user_id varchar(255) NOT NULL');
        DB::statement('ALTER TABLE `students_payment_log` MODIFY COLUMN user_id varchar(255) AFTER trans_id');
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
