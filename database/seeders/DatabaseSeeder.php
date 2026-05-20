<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nombre'      => 'docente',
                'descripcion' => 'Administrador del sistema con acceso total',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nombre'      => 'estudiante',
                'descripcion' => 'Usuario del simulador con acceso limitado',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        DB::table('permisos')->insert([
            ['nombre' => 'ver_dashboard',         'descripcion' => 'Ver el panel de estadísticas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'gestionar_estudiantes', 'descripcion' => 'Crear, editar y eliminar estudiantes', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'ver_actividades',       'descripcion' => 'Ver el registro de actividades', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'gestionar_modulos',     'descripcion' => 'Crear y editar módulos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'usar_simulador',        'descripcion' => 'Acceder al simulador de ciberseguridad', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('role_permiso')->insert([
            ['role_id' => 1, 'permiso_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['role_id' => 1, 'permiso_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['role_id' => 1, 'permiso_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['role_id' => 1, 'permiso_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('role_permiso')->insert([
            ['role_id' => 2, 'permiso_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('modulos')->insert([
            [
                'nombre'      => 'Comandos Básicos de Terminal',
                'descripcion' => 'Aprende los comandos fundamentales de Linux aplicados a ciberseguridad',
                'orden'       => 1,
                'activo'      => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nombre'      => 'Vulnerabilidad de Contraseñas',
                'descripcion' => 'Análisis de contraseñas débiles e identificación de riesgos en sistemas',
                'orden'       => 2,
                'activo'      => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        DB::table('students')->insert([
            [
                'nombre'               => 'Docente Admin',
                'usuario'              => 'docente',
                'contrasena'           => Hash::make('docente123'),
                'role_id'              => 1,
                'tutorial_completado'  => true,
                'created_at'           => now(),
                'updated_at'           => now(),
            ],
        ]);
    }
}