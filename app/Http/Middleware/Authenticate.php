<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permiso)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('backend/auth/login');
            }
        }

       if(!\Auth::user()->forzar_clave){
               return view('backend.usuario.cambiar_clave')
                        ->with([
                                'title'=>'cambiar clave',
                                'sub'=>'Cambio de clave',
                                'usuario'=>\Auth::user()
                            ]);
       }

        if($permiso== "tablero"){
                return $next($request);                
        }

        if(\Auth::user()->can($permiso)){
                return $next($request);            
            } else{
                abort(403);
        }

    }
}
