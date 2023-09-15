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
        DB::unprepared('

                CREATE PROCEDURE sp_cargueMaxiMin (IN ProbId INT, IN Observacion VARCHAR(50))
                BEGIN
                    INSERT INTO maximin (id_alternativa_estado, Seleccionada, Observacion)
                    SELECT
                        id_alternativa AS id_alternativa_estado,
                        (CASE MIN(valor) WHEN MAX(valor) THEN 1 ELSE 0 END) AS Seleccionada,
                        Observacion
                    FROM
                        alternativa_estado AS a
                        WHERE
                        id_problema = ProbId AND id_problema NOT IN(SELECT ae.id_problema FROM maximin mm INNER JOIN alternativa_estado ae ON ae.id = mm.id_alternativa_estado WHERE ae.id_problema = ProbId)
                        GROUP BY 
                            a.id_problema,
                            a.id_alternativa
                        ORDER BY Seleccionada DESC;
                        
                        SELECT mm.id, mm.Seleccionada, mm.Observacion, mm.id_alternativa_estado FROM maximin mm INNER JOIN alternativa_estado ae ON ae.id = mm.id_alternativa_estado WHERE ae.id_problema = ProbId;       
                END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_cargueMaxiMin');
    }
};
