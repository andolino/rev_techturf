<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStudentsPaymentLogAddColChargeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `students_payment_log` ADD COLUMN charge_id varchar(255) DEFAULT NULL');
        DB::statement('ALTER TABLE `students_payment_log` MODIFY COLUMN charge_id varchar(255) AFTER user_id');
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
