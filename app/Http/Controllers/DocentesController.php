<?php

namespace App\Http\Controllers;

use App\Models\Docentes;
use Illuminate\Http\Request;

class DocentesController extends Controller
{
    public function select()
    {
        try 
        {
            $docentes = $this->getDocentesSelect();

            if ($docentes->isEmpty()) 
            {
                return response()->json(['data' => 'No hay docentes'], 404);
            }
    
            return response()->json([
                'code' => 200,
                'data' =>$docentes
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function getDocentes()
    {
        try 
        {
            $docentes = Docentes::select(
                'docentes.id_docente',
                'users.name_user',
                'docentes.nombre_docente',
                'docentes.apellido_docente',

            )
            ->join('users', 'docentes.id_user', '=', 'users.id_user')
            ->get();

            if ($docentes->isEmpty()) 
            {
                return response()->json(['data' => ''], 404);
            }
    
            return response()->json([
                'code' => 200,
                'data' =>$docentes
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateDocenteData($request); 
            $existingDocente = Docentes::where('id_user', $request->id_user)->first();
            
            if ($existingDocente) {
    
                return response()->json([
                    'message' => 'Usuario ocupado',
                    'error' => 'El id de usuario ya está registrado con otro docente'
                ], 400); 
            }

            $docente = Docentes::create($validatedData);

            return response()->json([
                'message' => 'Docentes creado exitosamente',
                'docente' => $docente
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Docentes no creado',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id_docente)
    {
        try 
        {
            $validatedData = $this->validateDocenteData($request);

            $docente = Docentes::find($id_docente);

            if (!$docente) {
                return response()->json([
                    'message' => 'Docente no encontrado',
                ], 404);
            }

            if ($docente->id_user != $request->id_user) {
                $existingDocente = Docentes::where('id_user', $request->id_user)->first();
                
                if ($existingDocente) {
                    return response()->json([
                        'message' => 'Usuario ocupado',
                        'error' => 'El id de usuario ya está registrado con otro docente'
                    ], 400);
                }
            }

            $docente->update($validatedData);

            return response()->json([
                'message' => 'Docente actualizado exitosamente',
                'docente' => $docente
            ], 200);

        } catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Docente no actualizado',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id_docente)
    {
        try 
        {
            $docente = Docentes::find($id_docente);

            if (!$docente) {
                return response()->json([
                    'message' => 'Alumno no encontrado',
                ], 404);
            }

            $docente->delete();

            return response()->json([
                'message' => 'Docente eliminado exitosamente',
            ], 200);

        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Docente no eliminado',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function find($id_docente)
    {
        try {
            $docente = $this->getDocentesSelect($id_docente);

            if ($docente->isEmpty()) {
                return response()->json([
                    'message' => 'Docente no encontrado',
                ], 404);
            }

            return response()->json([
                'code' => 200,
                'data' =>$docente
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al buscar al Docente',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    private function validateDocenteData(Request $request)
    {
        return $request->validate([
            'nombre_docente' => 'required|string|max:30',
            'apellido_docente' => 'required|string|max:60',
            'direccion_docente' => 'required|string|max:120',
            'telefono_docente' => 'required|string|max:9',
            'correo_docente' => 'required|string|email|max:60',
            'especialidad' => 'required|string|max:25',
            'observaciones_docen' => 'nullable|string|max:225',
            'id_user' => 'required|exists:users,id_user',
        ]);
    }

    public function getDocentesSelect($id_docente = null)
    {
        $query = Docentes::select(
                'docentes.id_docente',
                'docentes.nombre_docente',
                'docentes.apellido_docente',
                'docentes.correo_docente',
                'docentes.especialidad',
                'docentes.telefono_docente',
                'docentes.direccion_docente',
                'docentes.observaciones_docen',
                'users.name_user',
                'users.email_user'
            )
            ->join('users', 'docentes.id_user', '=', 'users.id_user');
        
        if ($id_docente) {
            $query->where('docentes.id_docente', $id_docente);
        }
        return $query->get();
    }

}
