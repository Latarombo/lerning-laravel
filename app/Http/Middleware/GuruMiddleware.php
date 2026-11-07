<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class GuruMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $roles = $roles ?: ['guru'];

        if (Auth::check() && in_array(Auth::user()->role, $roles, true)) {
            return $next($request);
        }
        abort(403);
    }
}
