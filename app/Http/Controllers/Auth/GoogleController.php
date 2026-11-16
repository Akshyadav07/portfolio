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
        $sessionState = $request->session()->get('state');
        $callbackState = $request->query('state');

        \Illuminate\Support\Facades\Log::info('Google OAuth state check', [
            'session_has_state' => !empty($sessionState),
            'callback_has_state' => !empty($callbackState),
            'state_matches' => !empty($sessionState)
                && !empty($callbackState)
                && hash_equals($sessionState, $callbackState),
        ]);

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {

            \Illuminate\Support\Facades\Log::error(
                'Google OAuth callback failed',
                [
                    'exception_class' => get_class($e),
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ]
            );

            return redirect()->route('admin.login')
                ->with('error', 'Google authentication failed. Please try again.');
        }

        $authorizedEmail = config('services.google.admin_email', env('ADMIN_GOOGLE_EMAIL'));

        if (empty($authorizedEmail)) {
            abort(500, 'ADMIN_GOOGLE_EMAIL is not configured.');
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
