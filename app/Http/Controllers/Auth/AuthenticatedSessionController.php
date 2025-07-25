<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        return $request->user_name;
        if (Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password])) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // Redirect to dashboard after login
        }


        // If authentication fails, redirect back to login form with errors
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
