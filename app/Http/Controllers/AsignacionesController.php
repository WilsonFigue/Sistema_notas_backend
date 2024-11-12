<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use App\Models\Asignaciones;
use Illuminate\Http\Request;

class AsignacionesController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateAsignacionData($request);

            $existingAsignacion = Asignaciones::where('id_materia', $request->id_materia)
            ->where('id_grado', $request->id_grado)
            ->first();

            if ($existingAsignacion) {
                return response()->json([
                    'message' => 'Asignación ya existe',
                    'error' => 'Ya existe una asignación para ese año académico, materia y grado'
                ], 400);
            }
            $additionalData = [
                'año_academico_asig' => now(), 
            ];

            $asignacionesData = array_merge($validatedData, $additionalData);

            $asignacion = Asignaciones::create($asignacionesData);

            return response()->json([
                'message' => 'Asignación creada exitosamente',
                'asignacion' => $asignacion
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Asignación no creada',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id_asignacion)
    {
        try {
            $validatedData = $this->validateAsignacionData($request);

            $asignacion = Asignaciones::find($id_asignacion);

            if (!$asignacion) {
                return response()->json([
                    'message' => 'No se encontró la asignación para actualizar',
                    'error' => 'No existe una asignación con ese ID',
                    'data' => null
                ], 404);
            }
            $asignacion->update($validatedData);

            return response()->json([
                'message' => 'Asignación actualizada exitosamente',
                'data' => $asignacion
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al actualizar la asignación',
                'error' => $th->getMessage()
            ], 500);
        }
    }



    public function find($id_grado, $id_materia)
    {
       
        try {
            $cantidadAlumnos = Alumnos::where('id_grado', $id_grado)->count(); 

            $asignacion = Asignaciones::where('id_grado', $id_grado)
                ->where('id_materia', $id_materia)
                ->first();
            
            if (!$asignacion) {
                return response()->json([
                    'message' => 'No se encontraron datos de asignación',
                    'error' => 'No existe una asignación para ese grado y materia',
                    'data' => null,
                    'cantidad_alumnos' => $cantidadAlumnos 
                ], 404);
            }

            

            return response()->json([
                'message' => 'Asignación encontrada',
                'data' => $asignacion,
                'cantidad_alumnos' => $cantidadAlumnos 
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al buscar la asignación',
                'error' => $th->getMessage(),
                'cantidad_alumnos' => 0
            ], 500);
        }
    }

    


    private function validateAsignacionData(Request $request)
    {
        return $request->validate([
            'id_materia' => 'required|exists:materias,id_materia',
            'id_grado' => 'required|exists:grados,id_grado',
            'id_docente' => 'required|exists:docentes,id_docente',
        ]);
    }


}
