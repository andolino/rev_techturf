<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeProceedureFnGetCtr extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        DB::unprepared(" 
                    CREATE FUNCTION fn_get_ctr(p_trans_code VARCHAR(20), p_yr INT) RETURNS varchar(100) CHARSET utf8mb4
                        BEGIN
                            DECLARE val INT;
                            DECLARE len INT;
                            DECLARE pre char(30);
                            DECLARE suf char(30);
                            DECLARE bch char(30);

                            SELECT current_value, counter_length, prefix, suffix 
                            INTO val, len, pre, suf		
                            FROM counter
                            WHERE counter_code COLLATE utf8mb4_general_ci = p_trans_code;

                            IF p_yr > CONVERT(suf, unsigned INTEGER) THEN
                                SET val = 1;
                            ELSE
                                SET val = val + 1;
                            END IF;

                            UPDATE counter
                            SET current_value = val,
                                suffix = p_yr
                            WHERE counter_code COLLATE utf8mb4_general_ci = p_trans_code;

                            RETURN CONCAT(pre,'-',bch,LPAD(CONVERT(val, CHAR(30)),len,'0'),'-',suf);
                            END
                    ");
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
