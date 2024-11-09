<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validacion = Validator::make($request->all(), [
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
    try {
        // Se validan los campos que se reciben
        $validacion = Validator::make($request->all(), [
            'email_user' => 'required',
            'password' => 'required'
        ]);

        if ($validacion->fails()) {
            // Si la validación no se cumple, se retornan los mensajes de error
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            // Se verifica que el email_user y password pertenezcan a un usuario
            if (Auth::attempt(['email_user' => $request->email_user, 'password' => $request->password])) {
                // Se extraen los datos del usuario que coincida
                $usuario = User::where('email_user', $request->email_user)->first();
                
                return response()->json([
                    'code' => 200,
                    // Se retornan los datos del usuario
                    'data' => $usuario,
                    // Se crea un token para el usuario
                    'token' => $usuario->createToken('api-key')->plainTextToken
                ], 200);
            } else {
                // Si el email_user y password no pertenecen a un usuario registrado,
                // se retorna un mensaje con código 401
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
