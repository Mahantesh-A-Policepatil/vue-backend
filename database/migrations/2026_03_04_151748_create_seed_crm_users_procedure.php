<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS seed_crm_users');

        DB::unprepared(<<<'SQL'
            CREATE PROCEDURE seed_crm_users(IN total_records INT)
            BEGIN
                DECLARE i INT DEFAULT 1;

                WHILE i <= total_records DO
                    INSERT INTO crm_users (first_name, last_name, age, department, city, created_at, updated_at)
                    VALUES (
                        CONCAT('First', i),
                        CONCAT('Last', i),
                        18 + FLOOR(RAND() * 42),
                        ELT(1 + FLOOR(RAND() * 5), 'Sales', 'Engineering', 'Support', 'Finance', 'HR'),
                        ELT(1 + FLOOR(RAND() * 5), 'New York', 'London', 'Tokyo', 'Berlin', 'Mumbai'),
                        NOW(),
                        NOW()
                    );

                    SET i = i + 1;
                END WHILE;
            END
        SQL);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::unprepared('DROP PROCEDURE IF EXISTS seed_crm_users');
    }
};
