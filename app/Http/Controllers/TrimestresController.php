<?php

namespace App\Http\Controllers;

use App\Models\Trimestres;
use Illuminate\Http\Request;

class TrimestresController extends Controller
{
    public function getTrimestres()
    {
        try 
        {
            $currentYear = date('Y');
            $trimestres = Trimestres::select(
                    'id_trimestre',
                    'nombre_trimestre',
                )
                ->where('año_academico_trimes', $currentYear) 
                ->get();

           
            if ($trimestres->isEmpty()) 
            {
                return response()->json(['data' => ''], 404);
            }
            
            return response()->json([
                'code' => 200,
                'data' =>$trimestres
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }

}
