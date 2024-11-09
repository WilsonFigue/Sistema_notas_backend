<?php

namespace App\Http\Controllers;

use App\Models\Secciones;
use Illuminate\Http\Request;

class SeccionesController extends Controller
{
    public function getSecciones()
    {
        try 
        {
            $encargados = Secciones::select(
                'id_seccion',
                'nombre_seccion',
            )

            ->get();

            if ($encargados->isEmpty()) 
            {
                return response()->json(['data' => ''], 404);
            }
    
            return response()->json($encargados);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }
}
