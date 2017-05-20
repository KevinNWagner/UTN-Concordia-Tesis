<?php

namespace sisAdmin\Http\Middleware;

use Closure;

class MidUserAdmin
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
        $usuario_actual=\Auth::user();
        if($usuario_actual->Tipos_idTipos!=1){
           return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
