<?php

namespace App\Http\Controllers;

use App\Models\Maximin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaximinController extends Controller
{
        
    public function Consultar()
    {
        try {
            $datos = Maximin::get();
            if($datos->count() == 0){
                return response()->json(['mensaje' => 'No existen registros, ejecuta los procedim'], 404);
            }
            return response()->json($datos, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function ejecutarProcedimientoAlmacenado($parametro1, $parametro2)
{

    // Llama al procedimiento almacenado con los parámetros
    $resultado = DB::select('CALL sp_cargueMaxiMin(?, ?)', [$parametro1, $parametro2]);
    //dd($parametro1,$parametro2);
    //Devolver Resultados en respuesta Json
    return response()->json([
        'resultado' => $resultado
    ]);
}


    private function mensajePerzonalizado($resp,  $mensajeExitoso,  $mesajeError){
        $mensaje = $resp ? $mensajeExitoso : $mesajeError;
        $statusCode = $resp ? 200 : 404;
        return response()->json(['mensaje' => $mensaje], $statusCode);
    }
}
