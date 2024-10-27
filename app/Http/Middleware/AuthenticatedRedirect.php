<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedRedirect
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // Check if the user is authenticated with the specified guard
            if (Auth::guard($guard)->check()) {
                // Redirect based on the guard name
                if ($guard === 'instructor') {
                    return redirect()->route('instructor.dashboard');
                } elseif ($guard === 'super_admin') {
                    return redirect()->route('admin.dashboard');
                }

                // Redirect to a default page if the guard is neither instructor nor super_admin
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
