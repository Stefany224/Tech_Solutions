<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller {
    // funcion para registrar un usuario nuevo, con la clave cifrada antes de guardarla
    public function register(Request $request) {
        // validamos los datos que llegan del formulario
       $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|regex:/^[\pL\s]+$/u',
            'correo' => ['required', 'string', 'max:255', 'unique:usuarios,correo', 'regex:/^[a-zA-Z0-9][a-zA-Z0-9._%+-]*@[a-zA-Z0-9][a-zA-Z0-9-]*\.(com|cl)$/'],
            'clave'  => 'required|string|min:8',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.regex'    => 'El nombre solo puede contener letras y espacios',
            'correo.required' => 'El correo es obligatorio',
            'correo.regex' => 'El correo debe tener un formato valido',
            'correo.unique'   => 'Este correo ya esta registrado',
            'clave.required'  => 'La clave es obligatoria',
            'clave.min'       => 'La clave debe tener al menos 8 caracteres',
        ]);

        // si falla la validacio devolvemos los errores de cliente 422
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // creamos el usuario  cifrando la clave con Hash
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'clave'  => Hash::make($request->clave),
        ]);

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'usuario' => $usuario,
        ], 201);
    }

    // login para validar credenciales y devolvemos un JWT si son correctas
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'correo' => 'required|string|email',
            'clave'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth('api')->attempt([
            'correo' => $request->correo,
            'password' => $request->clave,
        ])) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}