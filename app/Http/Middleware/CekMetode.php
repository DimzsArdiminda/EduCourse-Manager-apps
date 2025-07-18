<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekMetode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if ($request->routeIs('quiz.show')) {
                return $next($request);
            }

            if (Auth::user()->hasRole('guru') || Auth::user()->minat !== null) {
                return $next($request);
            } else {
                return redirect()->route('quiz.show');
            }
        }

        return redirect()->route('login');
    }
}
