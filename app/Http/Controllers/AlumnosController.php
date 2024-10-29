<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{
    public function select()
    {
        try 
        {
            $alumnos = Alumnos::select(
                'alumnos.id_alumno',
                'alumnos.nombre_alumno',
                'alumnos.apellido_alumno',
                'alumnos.genero_alumno',
                'alumnos.foto_alumnos',
                'alumnos.estado_alumno',
                'alumnos.observaciones_alumn',
                'alumnos.direccion_alumno',
                'alumnos.correo_alumno',
                'alumnos.telefono_alumno',
                'alumnos.fecha_ingreso',
                'secciones.nombre_seccion',
                'grados.nombre_grado',
                'encargados.name_encargado',
                'encargados.apellido_encargado'
            )
            ->join('secciones', 'alumnos.id_seccion', '=', 'secciones.id_seccion')
            ->join('grados', 'alumnos.id_grado', '=', 'grados.id_grado')
            ->join('encargados', 'alumnos.id_encargado', '=', 'encargados.id_encargado')
            ->get();

            if ($alumnos->isEmpty()) 
            {
                return response()->json(['data' => 'No hay clientes'], 404);
            }
    
            return response()->json($alumnos);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try 
        {
            $validatedData = $this->validateAlumnoData($request);
    
            $additionalData = [
                'id_alumno' => 'A2222', 
                'fecha_ingreso' => now(), 
                'estado_alumno' => true, 
            ];
    
            $alumnoData = array_merge($validatedData, $additionalData);
    
            $alumno = Alumnos::create($alumnoData);
    
            return response()->json([
                'message' => 'Alumno creado exitosamente',
                'alumno' => $alumno
            ], 201);
        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Alumno no creado',
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
            'direccion_alumno' => 'required|string|max:120',
            'telefono_alumno' => 'required|string|max:9',
            'correo_alumno' => 'required|string|email|max:60',
            'observaciones_alumn' => 'nullable|string|max:225',
            'foto_alumnos' => 'nullable|string|max:60',
            'id_encargado' => 'required|exists:encargados,id_encargado',
            'id_seccion' => 'required|exists:secciones,id_seccion',
            'id_grado' => 'required|exists:grados,id_grado',
        ]);
    }
    
    


}
