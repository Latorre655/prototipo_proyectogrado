<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DocenteAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('docente_logged')) {
            return redirect('/docente/login')
                   ->withErrors(['error' => 'Debes iniciar sesión para acceder.']);
        }
        return $next($request);
    }
}