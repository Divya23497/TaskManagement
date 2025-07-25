<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        // return "hi";
        return view('login'); // Your login view is the 'welcome' view.
    }

    // Handle login authentication
    public function login(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt authentication using the provided credentials
        $credentials = $request->only('username', 'password');

        // Find the user by username first
        $user = User::where('user_name', $request->username)->first();

        if (!$user) {
            // If the user is not found, return an error response
            return back()->withErrors([
                'username' => 'User not found',
            ])->with('swal', 'User not found. Please try again.');
        }

        // Now validate the password using Hash::check()
        if (!\Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'The provided credentials do not match our records.',
            ])->with('swal', 'The provided credentials do not match our records.');
        }
        else{


        // return $user;
        // Log the user in
        Auth::login($user);

        session([
            'user_type' => $user->user_type,  // Store user type
            'username' => $user->user_name    // Store username
        ]);

        // Redirect the user to the intended page or the tasks page if no previous destination is set
        return redirect()->intended(route('tasks'));
    }
    }

    // Log the user out
    public function logout()
    {

        Auth::logout(); // Log out the user

        // Invalidate the session
        request()->session()->invalidate();

        // Regenerate the session token to protect against session fixation attacks
        request()->session()->regenerateToken();

        // return view('login');
        return redirect()->route('login'); // Redirect to the login page after logout
    }

}
