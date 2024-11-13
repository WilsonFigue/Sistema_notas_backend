<?php

namespace App\Http\Controllers;

use App\Models\Docentes;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function getUsers()
    {
        try 
        {
            $users = User::select(
                    'users.id_user',
                    'users.name_user'
                )
                ->leftJoin('docentes', 'users.id_user', '=', 'docentes.id_user')  
                ->whereNull('docentes.id_user')  
                ->get();
    
            if ($users->isEmpty()) 
            {
                return response()->json(['data' => 'No hay usuarios disponibles'], 404);
            }
        
            return response()->json([
                'code' => 200,
                'data' =>$users
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function select()
    {
        try 
        {
            $users = DB::table('users')->select(
                'id_user',
                'name_user',
                'rol',
                'email_user',
                'created_at',
                'updated_at'
            )->get();

            if ($users->isEmpty()) 
            {
                return response()->json(['message' => 'No hay usuarios disponibles'], 404);
            }

            return response()->json([
                'code' => 200,
                'data' =>$users
            ], 200);
        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Error al obtener los usuarios',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $validacion = Validator::make($request->all(), [
                'name_user' =>'required|unique:users,name_user',
                'email_user' => 'required|email|unique:users,email_user',
                'password' => 'required|min:8',
                'rol' => 'required|max:20'
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            }

            $usuario = User::create([
                'name_user' => $request->input('name_user'),
                'email_user' => $request->input('email_user'),
                'password' => bcrypt($request->input('password')), 
                'rol' => $request->input('rol'),
            ]);

            return response()->json([
                'code' => 200,
                'data' => 'Usuario creado exitosamente',
                'token' => $usuario->createToken('api-key')->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
{
    try 
    {
        $validacion = Validator::make($request->all(), [
            'email_user' => 'required',
            'password' => 'required'
        ]);

        if ($validacion->fails()) 
        {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
            
        } else 
        {
            if (Auth::attempt(['email_user' => $request->email_user, 'password' => $request->password]))
            {
                $usuario = User::where('email_user', $request->email_user)->first();
                
                // Verificamos si el rol del usuario es "docente"
                if ($usuario->rol === 'docente') 
                {
                    // Capturamos el id del docente desde la tabla `docentes`
                    $docente = Docentes::where('id_user', $usuario->id_user)->first();

                    if ($docente) {
                        $id_docente = $docente->id_docente; // Capturamos el id_docente
                    } 
                }

                return response()->json([
                    'code' => 200,
                    'data' => [
                        'id_user' => $usuario->id_user,
                        'name_user' => $usuario->name_user,
                        'rol' => $usuario->rol,
                        'id_docente' => $id_docente ?? null
                    ],
                    'token' => $usuario->createToken('api-key')->plainTextToken
                ], 200);
            } else 
            {
                return response()->json([
                    'code' => 401,
                    'data' => 'Usuario no autorizado',
                ], 401);
            }
        }
    } catch (\Throwable $th) {
        return response()->json($th->getMessage(), 500);
    }
}


    public function updatePassword(Request $request, $id_user)
    {
        try {
            $validacion = Validator::make($request->all(), [
                'password' => 'required|min:8|confirmed' 
            ]);

            if ($validacion->fails()) {
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            }

            $user = User::find($id_user);

            if (!$user) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Usuario no encontrado'
                ], 404);
            }
            
            $user->password = bcrypt($request->input('password')); 
            $user->save();

            return response()->json([
                'code' => 200,
                'data' => 'Contraseña actualizada correctamente'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($id_user)
    {
        try 
        {
            $user = User::find($id_user);

            if (!$user) {
                return response()->json([
                    'message' => 'Usuario no encontrado',
                ], 404);
            }

            $user->delete();

            return response()->json([
                'code' => 200,
                'data' => 'Usuario eliminado exitosamente',
            ], 200);

        } 
        catch (\Throwable $th) 
        {
            return response()->json([
                'message' => 'Usuario no eliminado',
                'error' => $th->getMessage()
            ], 500);
        }
    }



}
