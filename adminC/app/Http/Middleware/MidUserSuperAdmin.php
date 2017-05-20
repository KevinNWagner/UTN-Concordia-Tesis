<?php

namespace sisAdmin\Http\Middleware;

use Closure;

class MidUserSuperAdmin
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
        if($usuario_actual->Tipos_idTipos!=100){
           return response('Unauthorized.', 401);
        }
      
        return $next($request);
    }
}
