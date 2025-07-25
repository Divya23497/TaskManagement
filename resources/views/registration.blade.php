@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')

<div class="registration-wrapper">

    <div class="registration-box">
        <h2>Registration</h2>
        <form method="POST" action="{{ route('registration') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>

            <button type="submit" class="registration-btn">registration</button>

            <div class="extra-links">
                <a href="{{ route('password.request') }}">Forgot Password?</a><br>
                <a href="{{ route('register') }}">Don't have an account?</a>
            </div>
        </form>
    </div>
</div>
@endsection
    <script>
        function togglePassword() {
            const pwd = document.getElementById("password");
            pwd.type = pwd.type === "password" ? "text" : "password";
        }
    </script>


