<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    /**
     * Redirect the user to Google's OAuth page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google after authentication.
     * Only the authorized admin email (from .env) is allowed in.
     */
    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('admin.login')
                ->with('error', 'Google authentication failed. Please try again.');
        }

        $authorizedEmail = env('ADMIN_GOOGLE_EMAIL');

        if (empty($authorizedEmail)) {
            abort(500, 'ADMIN_GOOGLE_EMAIL is not configured in .env');
        }

        // Strict single-admin check
        if (strtolower(trim($googleUser->getEmail())) !== strtolower(trim($authorizedEmail))) {
            return redirect()->route('admin.login')
                ->with('error', 'Access denied. This Google account is not authorized.');
        }

        // Store admin session data
        Session::put('admin_logged_in', true);
        Session::put('admin_name', $googleUser->getName());
        Session::put('admin_email', $googleUser->getEmail());
        Session::put('admin_avatar', $googleUser->getAvatar());

        return redirect()->route('admin.dashboard')
            ->with('success', 'Welcome back, ' . $googleUser->getName() . '!');
    }

    /**
     * Log the admin out and destroy the session.
     */
    public function logout(Request $request)
    {
        Session::forget([
            'admin_logged_in',
            'admin_name',
            'admin_email',
            'admin_avatar',
        ]);

        return redirect()->route('admin.login')
            ->with('success', 'You have been logged out successfully.');
    }
}
