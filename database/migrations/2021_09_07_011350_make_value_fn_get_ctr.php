<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeValueFnGetCtr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("INSERT INTO heygodb.counter
                        (id, counter_for, counter_code, current_value, counter_length, prefix, suffix, created_at, updated_at)
                        VALUES(1, 'Students', 'INVS', 0, 8, 'INVS', '2021', NULL, NULL);
                        INSERT INTO heygodb.counter
                        (id, counter_for, counter_code, current_value, counter_length, prefix, suffix, created_at, updated_at)
                        VALUES(2, 'Teachers', 'INVT', 0, 8, 'INVT', '2021', NULL, NULL);");
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
