<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function UpdateOrCreate(Request $request)
    {
        $validated = $request->validate([
            'id_alumno' => 'required|exists:alumnos,id_alumno',
            'id_asignacion' => 'required|exists:asignaciones,id_asignacion',
            'id_trimestre' => 'required|exists:trimestres,id_trimestre',
            'nota_1' => 'nullable|numeric|min:0|max:100',
            'nota_2' => 'nullable|numeric|min:0|max:100',
            'nota_3' => 'nullable|numeric|min:0|max:100',
            'observaciones_not' => 'nullable|string|max:255',
        ]);
    
        // Usamos updateOrCreate para actualizar o crear el registro
        Notas::updateOrCreate(
            [
                'id_alumno' => $validated['id_alumno'],
                'id_asignacion' => $validated['id_asignacion'],
                'id_trimestre' => $validated['id_trimestre'],
            ],
            [
                'nota_1' => $validated['nota_1'] ?? null,
                'nota_2' => $validated['nota_2'] ?? null,
                'nota_3' => $validated['nota_3'] ?? null,
                'observaciones_not' => $validated['observaciones_not'] ?? '',
            ]
        );
    
        // Devolver una respuesta simple de éxito
        return response()->json([
            'code' => 200,
            'message' => 'Notas actualizadas o creadas con éxito.'
        ], 200);
    }
    

    public function findModel($id_alumno, $id_asignacion, $id_trimestre)
    {
        try {
            $nota = Notas::where('id_alumno', $id_alumno)
                ->where('id_asignacion', $id_asignacion)
                ->where('id_trimestre', $id_trimestre)
                ->first();

            if ($nota) {
                return response()->json([
                    'code' => 200,
                    'data' => $nota
                ], 200);
            }

            $nota = Notas::create([
                'nota_1' => null,  
                'nota_2' => null,
                'nota_3' => null,
                'observaciones_not' => '',  
                'id_alumno' => $id_alumno,
                'id_asignacion' => $id_asignacion,
                'id_trimestre' => $id_trimestre,
            ]);

            return response()->json([
                'code' => 201,
                'data' => $nota
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
