<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = DB::table('students')
                  ->where('usuario', $request->usuario)
                  ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales invalidas'
            ]);
        }

        if (!Hash::check($request->contrasena, $user->contrasena)) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciales invalidas'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login exitoso.',
            'nombre'  => $user->nombre
        ]);
    }
}