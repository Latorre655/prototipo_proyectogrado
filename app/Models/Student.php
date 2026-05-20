<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table    = 'students';
    protected $fillable = [
        'nombre',
        'usuario',
        'contrasena',
        'tutorial_completado',
        'ultimo_acceso',
        'role_id'
    ];
}