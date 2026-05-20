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
                'message' => 'Usuario incorrecto.'
            ]);
        }

        if (!Hash::check($request->contrasena, $user->contrasena)) {
            return response()->json([
                'success' => false,
                'message' => 'Contraseña incorrecta.'
            ]);
        }

        DB::table('students')
            ->where('usuario', $request->usuario)
            ->update(['ultimo_acceso' => now()]);

        $ultimoAcceso = DB::table('students')
            ->where('usuario', $request->usuario)
            ->value('ultimo_acceso');

        return response()->json([
            'success'               => true,
            'message'               => 'Login exitoso.',
            'nombre'                => $user->nombre,
            'tutorial_completado'   => $user->tutorial_completado,
            'ultimo_acceso'         => $ultimoAcceso
        ]);
    }

    public function marcarTutorial(Request $request)
    {
        DB::table('students')
            ->where('usuario', $request->usuario)
            ->update(['tutorial_completado' => true]);

        return response()->json(['success' => true]);
    }
}