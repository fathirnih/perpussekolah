<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InternalRoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $auth = $request->session()->get('internal_auth');

        if (! $auth || ! isset($auth['tipe'])) {
            return redirect()->route('login.internal');
        }

        if ($roles !== [] && ! in_array($auth['tipe'], $roles, true)) {
            if ($auth['tipe'] === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('petugas.dashboard');
        }

        return $next($request);
    }
}
