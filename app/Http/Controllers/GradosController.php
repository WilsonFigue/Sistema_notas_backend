<?php

namespace App\Http\Controllers;

use App\Models\Grados;
use Illuminate\Http\Request;

class GradosController extends Controller
{
    public function getGrados()
    {
        try 
        {
            $encargados = Grados::select(
                'id_grado',
                'nombre_grado',
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
