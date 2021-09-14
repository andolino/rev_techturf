<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStudentsPaymentLogAddColCurrency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `students_payment_log` ADD COLUMN currency varchar(50) DEFAULT NULL');
        DB::statement('ALTER TABLE `students_payment_log` MODIFY COLUMN currency varchar(50) AFTER refund_amount');
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
