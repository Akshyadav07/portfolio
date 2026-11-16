<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     * Protects all admin routes — only allows access if the admin is authenticated.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminEmail = config('auth.admin_email');

        if (!Auth::check() || !$adminEmail || strtolower(Auth::user()->email) !== strtolower($adminEmail)) {
            return redirect()->route('admin.login')
                ->with('error', 'Please log in to access the admin panel.');
        }

        return $next($request);
    }
}
