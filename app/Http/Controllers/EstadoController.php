<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function Consultar()
    {
        try {
            $datos = Estado::get();
            if($datos->count() == 0){
                return response()->json(['mensaje' => 'No existen Estados registrados'], 404);
            }
            return response()->json($datos, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function CrearEstado(Request $request)
    {
        try {
            $datos['descripcion'] = $request['descripcion'];
            $estado = new Estado($datos);
            $resp = $estado->save();
            $response = $this->mensajePerzonalizado($resp, 'Estado Creado', 'No se pudo crear el estado');
            return $response;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function EliminarEstado(string $id)
    {
        try {
            $estadoEncontrada = Estado::findOrfail($id);
            $resp = $estadoEncontrada->delete();
            $response = $this->mensajePerzonalizado($resp, 'Estado eliminado', 'Estado no encontrado');
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
