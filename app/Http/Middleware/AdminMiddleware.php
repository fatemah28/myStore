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
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return $next($request);
            } else {
                // Log out the client user
                Auth::logout();
                // Redirect to login page with an error message
                return redirect()->route('login')->with('error', 'Unauthorized access. Please log in as an admin.');
            }
        }

        // If the user is not authenticated, redirect to the login page
        return redirect()->route('login')->with('error', 'Please log in to access this page.');
    }
}
