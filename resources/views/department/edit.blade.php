@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Department</h5>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('department.update', $task->id) }}" method="post"
                                enctype="multipart/form-data" id="update_department">
                                @csrf
                                @method('PATCH')
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom03">Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ $department->name }}" placeholder="Name" />
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom03">Email</label>
                                        <input type="text" class="form-control" name="email" id="email"
                                            value="{{ $profile->email }}" placeholder="Email" />
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">User Type</label>
                                        <select class="form-control" name="user_type" required>
                                              <option value="">Select User Type</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->name }}"
                                                    {{ old('department', $user->user_type ?? '') == $department->name ? 'selected' : '' }}>
                                                    {{ ucfirst($department->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="valid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">User Name</label>
                                        <input type="text" name="username" id="username" class="form-control mb-1"
                                            placeholder="" value="{{ $profile->username }}">
                                        <div class="valid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">End Date</label>
                                        <input type="password" name="password" id="password" class="form-control mb-1"
                                            placeholder="" value="{{ $profile->password }}">
                                        <div class="valid-feedback"></div>
                                    </div>
                                </div>
                                <br>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
                                    <a href="{{ route('profile.update', $profile->id) }}" class="btn btn-dark mr-3" style="bottom: 15px; right: 15px;" type="back"
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
        function previewFiles(event) {
            const files = event.target.files;
            const previewArea = document.getElementById("previewArea");

            previewArea.innerHTML = ""; // Clear previous previews

            Array.from(files).forEach(file => {
                const fileURL = URL.createObjectURL(file);
                const container = document.createElement("div");
                container.style.maxWidth = "200px";

                // Handle image files
                if (file.type.startsWith("image/")) {
                    const img = document.createElement("img");
                    img.src = fileURL;
                    img.style.maxWidth = "100%";
                    img.style.border = "1px solid #ccc";
                    img.style.padding = "5px";
                    img.style.borderRadius = "8px";
                    container.appendChild(img);
                }
                // Handle PDF files
                else if (file.type === "application/pdf") {
                    const embed = document.createElement("embed");
                    embed.src = fileURL;
                    embed.type = "application/pdf";
                    embed.width = "100%";
                    embed.height = "200px";
                    embed.style.border = "1px solid #ccc";
                    container.appendChild(embed);
                }
                // Handle all other file types
                else {
                    const link = document.createElement("a");
                    link.href = fileURL;
                    link.textContent = `Download: ${file.name}`;
                    link.target = "_blank";
                    link.className = "btn btn-outline-secondary btn-sm d-block";
                    container.appendChild(link);
                }

                previewArea.appendChild(container);
            });
        }
    </script>
@endsection
