<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DocenteAuthController extends Controller
{
    public function showLogin()
    {
        if (Session::get('docente_logged')) {
            return redirect('/admin');
        }
        return view('docente.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario'    => 'required|string',
            'contrasena' => 'required|string',
        ]);

        $user = DB::table('students')
                  ->where('usuario', $request->usuario)
                  ->where('role_id', 1)
                  ->first();

        if (!$user || !Hash::check($request->contrasena, $user->contrasena)) {
            return back()->withErrors([
                'error' => 'Credenciales incorrectas o no tienes permiso de acceso.'
            ]);
        }

        Session::put('docente_logged', true);
        Session::put('docente_id',     $user->id);
        Session::put('docente_nombre', $user->nombre);

        DB::table('actividades')->insert([
            'student_id' => $user->id,
            'tipo'       => 'login_docente',
            'detalle'    => 'Inicio de sesión en el panel docente',
            'fecha'      => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin');
    }

    public function logout()
    {
        Session::forget(['docente_logged', 'docente_id', 'docente_nombre']);
        return redirect('/docente/login');
    }
}