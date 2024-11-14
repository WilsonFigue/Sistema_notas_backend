<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnosController extends Controller
{
    public function select()
    {
        try 
        {
            $alumnos = $this->getAlumnosSelect();

            if ($alumnos->isEmpty()) 
            {
                return response()->json(['data' => 'No hay alumnos'], 404);
            }
    
            return response()->json([
                'code' => 200,
                'data' =>$alumnos
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }
    public function selectAlumnosAsistencia($id_grado)
    {
        try {
            
            $alumnos = Alumnos::select(
                'alumnos.id_alumno',
                'alumnos.nombre_alumno',
                'alumnos.apellido_alumno',
                'alumnos.genero_alumno',
                'alumnos.foto_alumnos',
                'alumnos.estado_alumno',
                'alumnos.observaciones_alumn',
                'grados.id_grado',
                'grados.nombre_grado'
            )
            ->join('grados', 'alumnos.id_grado', '=', 'grados.id_grado')
            ->where('alumnos.id_grado', $id_grado) 
            ->get();

            if ($alumnos->isEmpty()) {
                return response()->json(['data' => 'No hay alumnos en esos grados'], 404);
            }
    
            return response()->json([
                'code' => 200,
                'data' => $alumnos
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function selectAlumnosGrados($id_docente)
    {
        try {
            $grados = DB::table('asignaciones') 
                        ->select('id_grado')
                        ->where('id_docente', $id_docente)
                        ->distinct()
                        ->get();
    
            if ($grados->isEmpty()) {
                return response()->json(['data' => 'No hay asignaciones para este docente'], 404);
            }

            $ids_grados = $grados->pluck('id_grado')->toArray();

            $alumnos = Alumnos::select(
                'alumnos.id_alumno',
                'alumnos.nombre_alumno',
                'alumnos.apellido_alumno',
                'alumnos.genero_alumno',
                'alumnos.foto_alumnos',
                'alumnos.estado_alumno',
                'alumnos.observaciones_alumn',
                'alumnos.fecha_ingreso',
                'grados.id_grado',
                'grados.nombre_grado'
            )
            ->join('grados', 'alumnos.id_grado', '=', 'grados.id_grado')
            ->whereIn('alumnos.id_grado', $ids_grados) 
            ->get();
    

            if ($alumnos->isEmpty()) {
                return response()->json(['data' => 'No hay alumnos en esos grados'], 404);
            }
    
            return response()->json([
                'code' => 200,
                'data' => $alumnos
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    



    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateAlumnoData($request); 
            $additionalData = [
                'fecha_ingreso' => now(), 
            ];

            $alumnoData = array_merge($validatedData, $additionalData);

            $alumno = Alumnos::create($alumnoData);

            return response()->json([
                'code' => 200,
                'data' => 'Alumno creado exitosamente',
                'alumno' => $alumno
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Alumno no creado',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id_alumno)
    {
        try 
        {
            $validatedData = $this->validateAlumnoData($request);

            $alumno = Alumnos::find($id_alumno);

            if (!$alumno) {
                return response()->json([
                    'message' => 'Alumno no encontrado',
                ], 404);
            }

            $alumno->update($validatedData);

            return response()->json([
                'code' => 200,
                'data' => 'Alumno actualizado exitosamente',
                'alumno' => $alumno
            ], 200);

        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Alumno no actualizado',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id_alumno)
    {
        try 
        {
            $alumno = Alumnos::find($id_alumno);

            if (!$alumno) {
                return response()->json([
                    'message' => 'Alumno no encontrado',
                ], 404);
            }

            $alumno->delete();

            return response()->json([
                'code' => 200,
                'data' => 'Alumno eliminado exitosamente',
            ], 200);

        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Alumno no eliminado',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function find($id_alumno)
    {
        try {
            $alumno = $this->getAlumnosSelect($id_alumno);

            if ($alumno->isEmpty()) {
                return response()->json([
                    'message' => 'Alumno no encontrado',
                ], 404);
            }

            return response()->json([
                'code' => 200,
                'data' =>$alumno
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al buscar al Alumno',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    private function validateAlumnoData(Request $request)
    {
        return $request->validate([
            'nombre_alumno' => 'required|string|max:30',
            'apellido_alumno' => 'required|string|max:60',
            'fecha_nacimiento' => 'required|date',
            'genero_alumno' => 'required|string|max:10',
            'estado_alumno' => 'required|boolean',
            'observaciones_alumn' => 'nullable|string|max:225',
            'foto_alumnos' => 'nullable|string|max:60',
            'id_encargado' => 'required|exists:encargados,id_encargado',
            'id_grado' => 'required|exists:grados,id_grado',
        ]);
    }

    public function getAlumnosSelect($id_alumno = null)

    {
        $query = Alumnos::select(
                'alumnos.id_alumno',
                'alumnos.nombre_alumno',
                'alumnos.apellido_alumno',
                'alumnos.fecha_nacimiento',
                'alumnos.genero_alumno',
                'alumnos.foto_alumnos',
                'alumnos.estado_alumno',
                'alumnos.observaciones_alumn',
                'alumnos.fecha_ingreso',
                'grados.nombre_grado',
                'encargados.nombre_encargado',
                'encargados.apellido_encargado'
            )
            ->join('grados', 'alumnos.id_grado', '=', 'grados.id_grado')
            ->join('encargados', 'alumnos.id_encargado', '=', 'encargados.id_encargado');
        
        if ($id_alumno) {
            $query->where('alumnos.id_alumno', $id_alumno);
        }

        return $query->get();
    }
    


}
