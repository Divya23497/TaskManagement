@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')

    {{-- <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-primary">
            <div class="card-header bg-info"></div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
            <form action="/store-todo" method="post">
                @csrf
                <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Task Name" value="">
                </div>
                <div class="form-group">
                        <textarea name="description" cols="5" rows="5" class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn-success">Create</button>
                    <button class="btn-secondary">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}
    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Add User</h5>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('profile.store') }}" method="post"
                                enctype="multipart/form-data" id="add_user">
                                @csrf
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom03">Name</label>
                                        <input type="text" class="form-control" name="profile_name" id="profile_name"
                                            value="" placeholder="Name" />

                                        <div class="invalid-feedback"></div>
                                    </div>


                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">Email</label>
                                        <input type="text" name="email" id="email" class="form-control mb-1"
                                            placeholder="">
                                        <div class="valid-feedback"></div>
                                    </div>
                                     <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">Department</label>

                                        <select class="form-control" name="user_type" id="user_type" required>
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->name }}">{{ ucfirst($department->name) }}
                                                </option>
                                            @endforeach
                                            </option>

                                        </select>
                                        <div class="valid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">User Name</label>
                                        <input type="text" name="user_name" id="user_name" class="form-control mb-1"
                                            placeholder="">
                                        <div class="valid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">Password</label>
                                        <input type="password" name="password" id="password" class="form-control mb-1"
                                            placeholder="">
                                        <div class="valid-feedback"></div>
                                    </div>
                                </div>
                                <br>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end">

                                    <a href="{{ route('users') }}" class="btn btn-dark mr-3" style="bottom: 15px; right: 15px;" type="back"
                                        name="btn_bck">Back</a>

                                    <button class="btn btn-primary " style="bottom: 15px; right: 15px;" type="submit"
                                        name="btn_save">Add User</button>
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
