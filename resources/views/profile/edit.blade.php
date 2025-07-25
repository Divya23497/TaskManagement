@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Profile</h5>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('profile.update', $users->id) }}" method="post"
                                enctype="multipart/form-data" id="update_profile">
                                @csrf
                                @method('PATCH')
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom03">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $users->name }}" placeholder="Name" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom03">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            value="{{ $users->email }}" placeholder="Email" />
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">User Type</label>
                                        <select class="form-control" name="user_type" required>
                                              <option value="">Select User Type</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->name }}"
                                                    {{ old('department', $users->user_type ?? '') == $department->name ? 'selected' : '' }}>
                                                    {{ ucfirst($department->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">User Name</label>
                                        <input type="text" name="user_name" id="user_name" class="form-control mb-1"
                                            placeholder="" value="{{ $users->user_name }}">
                                        <div class="valid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control"
                                                    value="">
                                                    <input type="hidden" name="password_old" id="password_old" class="form-control"
                                                    value="{{ $users->password }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                                <br>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
                                    <a href="{{ route('profile.update', $users->id) }}" class="btn btn-dark mr-3" style="bottom: 15px; right: 15px;" type="back"
                                        name="btn_bck">Back</a>

                                    <button class="btn btn-primary " style="bottom: 15px; right: 15px;" type="submit"
                                        name="btn_save">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
