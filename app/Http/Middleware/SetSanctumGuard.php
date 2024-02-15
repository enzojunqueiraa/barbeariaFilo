<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
Use Illuminate\Support\Str;

class SetSanctumGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Str::startsWith($request->getRequestUri(), '/api/admin')){
            config(['sanctum.guard' => 'administradors']);
        } else {
            return 'Sem guard';
        }
        return $next($request);
    }
}
