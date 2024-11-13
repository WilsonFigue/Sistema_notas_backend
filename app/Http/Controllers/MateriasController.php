<?php

namespace App\Http\Controllers;

use App\Models\Materias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
            return response()->json([
                'code' => 200,
                'data' =>$materias
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }

     public function selectMateriasDocente($id_docente, $id_grado)
    {
        try 
        {
            $materias = DB::table('asignaciones')
            ->select(
                'asignaciones.id_asignacion',
                'materias.nombre_materia' 
            )
            ->where('asignaciones.id_docente', $id_docente)  
            ->where('asignaciones.id_grado', $id_grado) 
            ->join('materias', 'asignaciones.id_materia', '=', 'materias.id_materia') 
            ->get();

            if ($materias->isEmpty()) 
            {
                return response()->json(['data' => ''], 404);
            }
    
            return response()->json([
                'code' => 200,
                'data' =>$materias
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }
}
