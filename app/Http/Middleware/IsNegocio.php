<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsNegocio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Valida si el usuario tiene permisos de Negocio (es un Negocio)
        if (Auth::user()->tipo == "1"):
            return $next($request);
            //return redirect('/registro-negocio');
        else:
            return redirect('/index');
        endif;
        
    }
}
