<?php

namespace App\Http\Controllers;

use App\Models\Alternativa;
use Illuminate\Http\Request;

class AlternativaController extends Controller
{
    public function Consultar()
    {
        try {
            $datos = Alternativa::get();
            if($datos->count() == 0){
                return response()->json(['mensaje' => 'No existen alternativas registradas'], 404);
            }
            return response()->json($datos, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function CrearAlternativa(Request $request)
    {
        try {
            $datos['descripcion'] = $request['descripcion'];
            $alternativa = new Alternativa($datos);
            $resp = $alternativa->save();
            $response = $this->mensajePerzonalizado($resp, 'Alternativa Creada', 'No se pudo crear la alternativa');
            return $response;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function EliminarAlternativa(string $id)
    {
        try {
            $alternativaEncontrada = Alternativa::findOrfail($id);
            $resp = $alternativaEncontrada->delete();
            $response = $this->mensajePerzonalizado($resp, 'Alternativa eliminada', 'Alternativa no encontrada');
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
