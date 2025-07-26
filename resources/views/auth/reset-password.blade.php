@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card mt-5">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">Reset Password</h4>
                        </div>
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('custom.password.update') }}">
                                @csrf

                               <input type="text" name="token" value="{{ $token }}">
                                <input type="email" name="email" value="{{  $email }}">

                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-success">Reset Password</button>
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
