<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $students = DB::table('students')->orderBy('nombre')->get();
        return view('admin.index', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:100',
            'usuario'    => 'required|string|max:50|unique:students,usuario',
            'contrasena' => 'required|string|min:4',
        ]);

        DB::table('students')->insert([
            'nombre'     => $request->nombre,
            'usuario'    => $request->usuario,
            'contrasena' => Hash::make($request->contrasena),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin')->with('success', 'Estudiante agregado correctamente.');
    }

    public function destroy($id)
    {
        DB::table('students')->where('id', $id)->delete();
        return redirect('/admin')->with('success', 'Estudiante eliminado.');
    }
}