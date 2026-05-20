<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Progreso;

class ProgresoController extends Controller
{
    public function guardar(Request $request)
    {
        $usuario            = $request->input('usuario');
        $moduloId           = $request->input('modulo_id');
        $bloquesCompletados = $request->input('bloques_completados');
        $totalBloques       = $request->input('total_bloques');
        $bloqueActual       = $request->input('bloque_actual');

        $student = Student::where('usuario', $usuario)->first();
        if (!$student) {
            return response()->json(['success' => false, 'message' => 'Estudiante no encontrado']);
        }

        $completado = $bloquesCompletados >= $totalBloques;

        Progreso::updateOrCreate(
            ['student_id' => $student->id, 'modulo_id' => $moduloId],
            [
                'tareas_completadas' => $bloquesCompletados,
                'total_tareas'       => $totalBloques,
                'bloque_actual'      => $bloqueActual,
                'completado'         => $completado,
                'fecha_inicio'       => now(),
                'fecha_completado'   => $completado ? now() : null,
            ]
        );

        return response()->json(['success' => true, 'completado' => $completado]);
    }

    public function consultar(Request $request)
    {
        $usuario = $request->input('usuario');

        $student = Student::where('usuario', $usuario)->first();
        if (!$student) {
            return response()->json(['success' => false, 'progresos' => []]);
        }

        $progresos = Progreso::where('student_id', $student->id)->get();

        $data = $progresos->map(fn($p) => [
            'modulo_id'           => $p->modulo_id,
            'bloques_completados' => $p->tareas_completadas,
            'total_bloques'       => $p->total_tareas,
            'bloque_actual'       => $p->bloque_actual,
            'completado'          => (bool) $p->completado,
        ]);

        return response()->json(['success' => true, 'progresos' => $data]);
    }
}