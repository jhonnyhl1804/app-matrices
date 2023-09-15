<?php

namespace App\Http\Controllers;

use App\Models\Alternativa_Estado;
use Illuminate\Http\Request;

class Alternativa_EstadoController extends Controller
{
    public function Consultar()
    {
        try {
            $datos = Alternativa_Estado::get();
            if($datos->count() == 0){
                return response()->json(['mensaje' => 'No existen alternativa de estado registradas'], 404);
            }
            return response()->json($datos, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function CrearAlternativaEstado(Request $request)
    {
        try {
            $datos['id_estado'] = $request['estadoid'];
            $datos['id_alternativa'] = $request['alternativaid'];
            $datos['id_problema'] = $request['problemaid'];
            $datos['valor'] = $request['valor'];
            $alternativaEstado = new Alternativa_Estado($datos);
            $resp = $alternativaEstado->save();
            $response = $this->mensajePerzonalizado($resp, 'Alternativa estado creada', 'No se pudo crear la alternativa esrado');
            return $response;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function EliminarAlternativaEstado(string $id)
    {
        try {
            $alternativaEstadoEncontrada = Alternativa_Estado::findOrfail($id);
            $resp = $alternativaEstadoEncontrada->delete();
            $response = $this->mensajePerzonalizado($resp, 'Alternativa estado eliminada', 'Alternativa estado no encontrada');
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
