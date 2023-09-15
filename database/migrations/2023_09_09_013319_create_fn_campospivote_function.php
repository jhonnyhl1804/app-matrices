<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE FUNCTION fn_campospivote (probId INT) RETURNS TEXT CHARSET latin1 COLLATE latin1_swedish_ci
            BEGIN
                DECLARE res TEXT DEFAULT '';
                DECLARE campo VARCHAR(255);
                DECLARE done INT DEFAULT 0;

                DECLARE termina BOOL DEFAULT FALSE;

                DECLARE nombreestados CURSOR FOR SELECT DISTINCT e.descripcion
                FROM alternativa_estado ae
                INNER JOIN estado e ON e.id = ae.id_estado
                WHERE ae.id_problema = probId;

                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

                OPEN nombreestados;
                lectura: LOOP
                    FETCH nombreestados INTO campo;

                    IF done THEN
                        LEAVE lectura;
                    END IF;

                    SET res = CONCAT(res, 'SUM( IF( tabla.estatus = \'', campo, '\', tabla.valor, NULL ) ) AS ', campo, ', ');
                END LOOP;
                CLOSE nombreestados;

                IF LENGTH(res) > 0 THEN
                    SET res = SUBSTRING(res, 1, LENGTH(res) - 2); -- Elimina la última coma y espacio.
                        IF LENGTH(res)>0 THEN
                            SET res=CONCAT(',',res);
                        END IF;
                END IF;
                RETURN res;
            END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS fn_campospivote');
    }
};
