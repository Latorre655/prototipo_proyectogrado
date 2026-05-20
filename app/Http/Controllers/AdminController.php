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

        $roles = DB::table('roles')->get();
        foreach ($roles as $rol) {
            $rol->permisos = DB::table('permisos')
                ->join('role_permiso', 'permisos.id', '=', 'role_permiso.permiso_id')
                ->where('role_permiso.role_id', $rol->id)
                ->select('permisos.id', 'permisos.nombre', 'permisos.descripcion')
                ->get();
        }

        $todosLosPermisos = DB::table('permisos')->get();

        $estudiantesActivos = DB::table('students')
            ->where('role_id', 2)
            ->orderBy('ultimo_acceso', 'desc')
            ->get();

        $actividades = DB::table('actividades')
            ->join('students', 'actividades.student_id', '=', 'students.id')
            ->select('actividades.*', 'students.nombre', 'students.usuario')
            ->orderBy('actividades.fecha', 'desc')
            ->limit(20)
            ->get();

        return view('admin.index', compact(
            'students',
            'roles',
            'todosLosPermisos',
            'estudiantesActivos',
            'actividades'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:100',
            'usuario'    => 'required|string|max:50|unique:students,usuario',
            'contrasena' => 'required|string|min:4',
            'role_id'    => 'required|integer|in:1,2',
        ]);

        DB::table('students')->insert([
            'nombre'     => $request->nombre,
            'usuario'    => $request->usuario,
            'contrasena' => Hash::make($request->contrasena),
            'role_id'    => $request->role_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/admin')->with('success', 'Usuario agregado correctamente.');
    }

    public function destroy($id)
    {
        DB::table('students')->where('id', $id)->delete();
        return redirect('/admin')->with('success', 'Usuario eliminado.');
    }

    public function updatePermisos(Request $request, $role_id)
    {
        DB::table('role_permiso')->where('role_id', $role_id)->delete();

        $permisos = $request->input('permisos', []);
        foreach ($permisos as $permiso_id) {
            DB::table('role_permiso')->insert([
                'role_id'    => $role_id,
                'permiso_id' => $permiso_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect('/admin?tab=dashboard')->with('success', 'Permisos actualizados correctamente.');
    }
}