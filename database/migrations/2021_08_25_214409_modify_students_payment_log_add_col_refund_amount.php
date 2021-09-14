<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStudentsPaymentLogAddColRefundAmount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `students_payment_log` ADD COLUMN refund_amount double(8,2) DEFAULT 0');
        DB::statement('ALTER TABLE `students_payment_log` MODIFY COLUMN refund_amount double(8,2) AFTER amount');
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
