<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'ADMIN') {
            return $next($request);
        } else if (Auth::check() && Auth::user()->role !== 'ADMIN') {
            return redirect('/login')->with('message', 'You do not have permission!');
        } else if (Auth::check() === null || Auth::user() === null) {
            return back()->with('message', 'Login to continue!');
        }
        return back()->with('message', 'Unexpected error!');
    }
}
