@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Forgot Password</h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input id="email" type="email" name="email" class="form-control" required autofocus>
                            </div>

                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-primary">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

