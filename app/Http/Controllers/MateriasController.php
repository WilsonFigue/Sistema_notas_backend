<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    public function getMaterias()
    {
        try 
        {
            $materias = Materias::select(
                'id_materia',
                'nombre_materia',
            )

            ->get();

            if ($materias->isEmpty()) 
            {
                return response()->json(['data' => ''], 404);
            }
    
            return response()->json($materias);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }
}
