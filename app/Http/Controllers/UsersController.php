<?php

namespace App\Http\Controllers;

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
            $encargados = User::select(
                    'users.id_user',
                    'users.name_user'
                )
                ->leftJoin('docentes', 'users.id_user', '=', 'docentes.id_user')  
                ->whereNull('docentes.id_user')  
                ->get();
    
            if ($encargados->isEmpty()) 
            {
                return response()->json(['data' => 'No hay usuarios disponibles'], 404);
            }
        
            return response()->json($encargados);
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

            return response()->json($users, 200);
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
                'data' => $usuario,
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
                    
                    return response()->json([
                        'code' => 200,
                        'data' => $usuario,
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


}
