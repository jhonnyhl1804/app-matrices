<?php

namespace App\Http\Controllers;

use App\Models\Problema;
use Illuminate\Http\Request;

class ProblemaController extends Controller
{
    public function Consultar()
    {
        try {
            $datos = Problema::get();
            if($datos->count() == 0){
                return response()->json(['mensaje' => 'No existen problemas registrados'], 404);
            }
            return response()->json($datos, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function CrearProblema(Request $request)
    {
        try {
            $datos['descripcion'] = $request['descripcion'];
            $problema = new Problema($datos);
            $resp = $problema->save();
            $response = $this->mensajePerzonalizado($resp, 'Problema Creada', 'No se pudo crear la problema');
            return $response;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function EliminarProblema(string $id)
    {
        try {
            $problemaEncontrada = Problema::findOrfail($id);
            $resp = $problemaEncontrada->delete();
            $response = $this->mensajePerzonalizado($resp, 'Problema eliminada', 'Problema no encontrada');
            return $response;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    private function mensajePerzonalizado($resp,  $mensajeExitoso,  $mesajeError){
        $mensaje = $resp ? $mensajeExitoso : $mesajeError;
        $statusCode = $resp ? 200 : 404;
        return response()->json(['mensaje' => $mensaje], $statusCode);
    }
}
