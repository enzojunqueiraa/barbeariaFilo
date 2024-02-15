<?php

namespace App\Http\Middleware;

use App\Models\Administrador;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyAdminGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if(!Auth::user() instanceof Administrador){
            return response()->json([
                'status'=> false,
                'message'=> 'Não é uma instancia de ADM'
            ]);
        }
        return $next($request);
    }
}
