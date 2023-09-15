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
            CREATE PROCEDURE sp_campospivote (IN probId INT)
            BEGIN
                DECLARE camposp TEXT;
                DECLARE CONSULTA TEXT;

                -- Llamada a la función para obtener camposp
                SET camposp = fn_campospivote(probId);
                
                -- SELECT camposp;

                -- Construcción de la consulta dinámica
                SET CONSULTA = CONCAT(
                    'SELECT tabla.alternat ', camposp, '
                    FROM
                    (
                        SELECT
                            a.descripcion alternat, e.descripcion estatus, ae.valor
                        FROM
                            alternativa_estado ae
                            INNER JOIN alternativa a ON a.id = ae.id_alternativa
                            INNER JOIN estado e ON e.id = ae.id_estado
                        WHERE
                            ae.id_problema = ? 
                    ) tabla
                    GROUP BY
                        tabla.alternat' 
                );
                
				-- SELECT CONSULTA;
               -- Ejecución de la consulta dinámica
               PREPARE stmt FROM CONSULTA;   
               EXECUTE stmt USING probId;
               DEALLOCATE PREPARE stmt;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_campospivote');
    }
};
