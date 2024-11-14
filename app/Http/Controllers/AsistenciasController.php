<?php

namespace App\Http\Controllers;

use App\Models\Asistencias;
use Illuminate\Http\Request;

class AsistenciasController extends Controller
{
    public function findModel($id_asignacion, $fecha_asistencia)
{
    try {
        // Buscamos todas las asistencias que cumplan con el id_asignacion y fecha_asistencia
        $asistencias = Asistencias::where('id_asignacion', $id_asignacion)
            ->where('fecha_asistencia', $fecha_asistencia)
            ->get();

        // Validamos si encontramos asistencias
        if ($asistencias->isNotEmpty()) {
            // Si encontramos asistencias, las retornamos
            return response()->json([
                'message' => 'Asistencias encontradas',
                'data' => $asistencias
            ], 200);
        }

        // Si no encontramos asistencias, devolvemos un mensaje adecuado
        return response()->json([
            'message' => 'No se encontraron asistencias para los criterios dados',
            'data' => []
        ], 404);

    } catch (\Throwable $th) {
        // Manejo de errores
        return response()->json([
            'message' => 'Error al gestionar la asistencia',
            'error' => $th->getMessage()
        ], 500);
    }
}




    public function bulkUpdateOrCreateAsistencia(Request $request)
    {
        // Validamos que se reciba un array de asistencias
        $validated = $request->validate([
            'asistencias' => 'required|array',
            'asistencias.*.id_alumno' => 'required|exists:alumnos,id_alumno',
            'asistencias.*.id_asignacion' => 'required|exists:asignaciones,id_asignacion',
            'asistencias.*.fecha_asistencia' => 'required|date',
            'asistencias.*.asistencia' => 'required|boolean',
            'asistencias.*.observaciones' => 'nullable|string|max:225',
        ]);

        // Recorremos el array de asistencias y las procesamos
        foreach ($validated['asistencias'] as $asistenciaData) {
            Asistencias::updateOrCreate(
                [
                    'id_alumno' => $asistenciaData['id_alumno'],
                    'id_asignacion' => $asistenciaData['id_asignacion'],
                    'fecha_asistencia' => $asistenciaData['fecha_asistencia'],
                ],
                [
                    'asistencia' => $asistenciaData['asistencia'],
                    'observaciones' => $asistenciaData['observaciones'] ?? '',
                ]
            );
        }

        // Devolver una respuesta de éxito
        return response()->json([
            'code' => 200,
            'message' => 'Asistencias actualizadas o creadas con éxito.'
        ], 200);
    }



}
