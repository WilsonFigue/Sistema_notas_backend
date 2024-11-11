<?php

namespace App\Http\Controllers;

use App\Models\Encargado;
use Illuminate\Http\Request;

class EncargadoController extends Controller
{
    public function select()
    {
        try 
        {
            $encargado = Encargado::all();

            if ($encargado->isEmpty()) 
            {
                return response()->json(['data' => 'No hay encargados'], 404);
            }
    
            return response()->json([
                'code' => 200,
                'data' =>$encargado
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function getEncargados()
    {
        try 
        {
            $encargados = Encargado::select(
                'id_encargado',
                'nombre_encargado',
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

    public function store(Request $request)
    {
        try 
        {
            $validatedData = $this->validateEncargadoData($request);
    
            $encargado = Encargado::create($validatedData);
    
            return response()->json([
                'code' => 201,
                'data' => 'Encargado creado exitosamente',
                'encargado' => $encargado
            ], 201);
        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Encargado no creado',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id_encargado)
    {
        try 
        {
            $validatedData = $this->validateEncargadoData($request);

            $encargado = Encargado::find($id_encargado);

            if (!$encargado) {
                return response()->json([
                    'message' => 'Encargado no encontrado',
                ], 404);
            }

            $encargado->update($validatedData);

            return response()->json([
                'message' => 'Encargado actualizado exitosamente',
                'encargado' => $encargado
            ], 200);

        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Encargado no actualizado',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id_encargado)
    {
        try 
        {
            $encargado = Encargado::find($id_encargado);

            if (!$encargado) {
                return response()->json([
                    'message' => 'Encargado no encontrado',
                ], 404);
            }

            $encargado->delete();

            return response()->json([
                'message' => 'Encargado eliminado exitosamente',
            ], 200);

        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Encargado no eliminado',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function find($id_encargado)
    {
        try 
        {
            $encargado = Encargado::find($id_encargado);

            if (!$encargado) {
                return response()->json([
                    'message' => 'Encargado no encontrado',
                ], 404);
            }

            return response()->json([
                'code' => 200,
                'data' =>$encargado
            ], 200);

        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Error al buscar al encargado',
                'error' => $th->getMessage()
            ], 500);
        }
    }


    private function validateEncargadoData(Request $request)
    {
        return $request->validate([
            'nombre_encargado' => 'required|string|max:30',
            'apellido_encargado' => 'required|string|max:60',
            'telefono_encargado' => 'required|string|max:9',
            'correo_encargado' => 'required|string|email|max:60',
            'direccion_encargado' => 'required|string|max:120',
            'relacion_estudiante' => 'required|string|max:20',
            'DUI_encargado' => 'required|string|max:10',
        ]);
    }

}
