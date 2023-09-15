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
            CREATE PROCEDURE sp_cargueMaxiMax (IN ProbId INT, IN Observacion VARCHAR(50))
            BEGIN
                INSERT INTO MaxiMax (id_Alternativa_estado, Seleccionada, Observacion)
                SELECT
                    id_alternativa AS Alternativa,
                    CASE max(valor) WHEN (SELECT MAX(valor) FROM Alternativa_estado WHERE id_problema = ProbId) THEN 1 ELSE 0 END AS Seleccionada,
                    Observacion
                FROM
                    Alternativa_estado as a 
                    WHERE
                    id_problema = ProbId AND id_problema NOT IN(SELECT ae.id_problema FROM maximax mm INNER JOIN alternativa_estado ae ON ae.id = mm.id_alternativa_estado WHERE ae.id_problema = ProbId)
                GROUP BY 
                    a.id_problema,
                    a.id_alternativa
                ORDER BY Seleccionada DESC;
                
                SELECT mm.id, mm.Seleccionada, mm.Observacion, mm.id_alternativa_estado FROM maximax mm INNER JOIN alternativa_estado ae ON ae.id = mm.id_alternativa_estado WHERE ae.id_problema = ProbId;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_cargueMaxiMax');
    }
};
