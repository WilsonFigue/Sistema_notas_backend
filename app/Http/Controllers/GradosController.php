<?php

namespace App\Http\Controllers;

use App\Models\Grados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $grados = Grados::select(
                'id_grado',
                'nombre_grado',
            )

            ->get();

            if ($grados->isEmpty()) 
            {
                return response()->json(['data' => ''], 404);
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

    public function selectGradosDocente($id_docente)
    {
        try {
            $gradosIds = DB::table('asignaciones')
                ->where('id_docente', $id_docente)
                ->distinct() 
                ->pluck('id_grado');
    
            if ($gradosIds->isEmpty()) {
                return response()->json(['data' => 'No se encontraron grados asignados para el docente.'], 404);
            }
    
            $grados = DB::table('grados')
                ->whereIn('id_grado', $gradosIds)
                ->get();
    
            return response()->json([
                'code' => 200,
                'data' => $grados
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    

    
}
