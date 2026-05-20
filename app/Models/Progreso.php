<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progreso extends Model
{
    protected $table    = 'progresos';
    protected $fillable = [
        'student_id',
        'modulo_id',
        'completado',
        'tareas_completadas',
        'total_tareas',
        'fecha_inicio',
        'fecha_completado'
    ];
}