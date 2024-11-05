<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validacion = Validator::make($request->all(), [
                'id_user' => 'required|unique:users,id_user|max:15',
                'name_user' => 'required',
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
                'id_user' => $request->input('id_user'),
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

}
