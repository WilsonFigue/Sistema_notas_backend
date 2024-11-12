<?php

namespace App\Http\Controllers;

use App\Models\Grados;
use Illuminate\Http\Request;

class GradosController extends Controller
{

    public function select()
    {
        try 
        {
            $grados = Grados::all();

            if ($grados->isEmpty()) 
            {
                return response()->json(['data' => 'No hay grados'], 404);
            }
    
            return response()->json([
                'code' => 200,
                'data' =>$grados
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }

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
    
            return response()->json([
                'code' => 200,
                'data' =>$encargados
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }

    
}
