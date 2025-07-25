@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')

<div class=" row">
    <div class="col-lg-1"></div>

<div class="container-fluid p-4 d-flex justify-content-center align-items-center">
    <div class="login-wrapper row col-lg-10 d-flex align-items-stretch">
        <!-- Left: Login Box -->
        <div class="login-box col-lg-6 d-flex flex-column justify-content-center p-4">
           <h2> Welcome Back!</h2>
            <form method="POST" action="{{ route('login_welcome') }}">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" name="username" placeholder="Username" required class="form-control">
                </div>

                <div class="form-group mb-3 position-relative">
                    <input type="password" id="password" name="password" placeholder="Password" required class="form-control">
                    <span class="toggle-password position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;" onclick="togglePassword()">👁️</span>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>

                <div class="extra-links">
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
            </form>
        </div>

        <!-- Right: Image Box -->
        <div class="col-lg-6 d-flex justify-content-center align-items-center p-0">
            <img src="{{ asset('images/loginpage1.jpg') }}" alt="Login Illustration" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
    </div>
</div>



    <div class="col-lg-1"></div>
</div>
@endsection
    <script>
        function togglePassword() {
            const pwd = document.getElementById("password");
            pwd.type = pwd.type === "password" ? "text" : "password";
        }
    </script>


