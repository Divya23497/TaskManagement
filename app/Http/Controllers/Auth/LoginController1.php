<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('welcome'); // You can create this view in resources/views/auth/login.blade.php
    }

    public function login_authentication(Request $request){

      
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // return $request->username;
        $user = User::where('user_name', $request->username)->first();

        // return $user;    
        // Check if the user exists
        if (!$user) {

            return response()->json([
                'message' => 'User not found',
            ], 404);
        }
    
        // Check if the provided password matches the hashed password
        // if (!\Hash::check($request->password, $user->password)) {
        //     return response()->json([
        //         'message' => 'Invalid credentials',
        //     ], 401);
        // }

        $password = User::where('password', $request->password)->first();

        if (!$password) {
            return response()->json([
                'message' => 'Password not found',
            ], 404);
        }

    
        // You may want to generate a token for the user or start a session
        // Example: Generate a JWT token (if using Passport, Sanctum, or similar)
        $token = $user->createToken('TaskManagement')->plainTextToken;
    
        // Return a success response with token (if needed)
        // return response()->json([
        //     'message' => 'Login successful',
        //     'token' => $token, // Optional: Return the token if you're using token authentication
        //     'user' => $user, // Optionally return user data (excluding sensitive info)
        // ], 200);

       
        // return "hi";
        return redirect()->route('tasks');

    }

    // Handle the login logic
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/dashboard'); // Redirect to dashboard or home page
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Log the user out
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();

    // Regenerate the session token to protect against session fixation attacks
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}