@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Change Password</h5>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('profilepassword.update', $users->id) }}" method="post"
                                enctype="multipart/form-data" id="update_password">
                                @csrf
                                @method('PATCH')
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="password">Current Password</label>
                                        <div class="input-group">
                                            <input type="password" name="current_password" id="current_password" class="form-control"
                                                    value="">
                                                    <input type="type" name="password_old" id="password_old" class="form-control"
                                                    value="{{ $users->password }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="password">New Password</label>
                                        <div class="input-group">
                                            <input type="password" name="new_password" id="new_password" class="form-control"
                                                    value="">

                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="toggleNewPassword()" style="cursor: pointer;">
                                                    <i class="fas fa-eye" id="toggleNewIcon"></i>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="password">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                                    value="">
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="toggleConfirmPassword()" style="cursor: pointer;">
                                                    <i class="fas fa-eye" id="toggleConfirmIcon"></i>
                                                </span>
                                            </div>
                                        </div>
                                </div>
                            </div>
                                <br>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
                                    {{-- <a href="{{ route('password.update', $users->id) }}" class="btn btn-dark mr-3" style="bottom: 15px; right: 15px;" type="back"
                                        name="btn_bck">Back</a> --}}

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
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


    $('#current_password').on('keyup', function() {
      let current_password = $(this).val();
      let old_password= $("#password_old").val();
     // alert("old_password: " + old_password);

      if(old_password!=current_password){

      }
    });
</script>
@endsection
