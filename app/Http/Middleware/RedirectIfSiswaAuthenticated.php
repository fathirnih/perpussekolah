<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfSiswaAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $routeName = 'siswa.dashboard'): Response
    {
        if ($request->session()->has('siswa_auth')) {
            return redirect()->route($routeName);
        }

        return $next($request);
    }
}
