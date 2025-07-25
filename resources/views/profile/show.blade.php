@extends('layouts.app')

@section('title', 'user Management System')

@section('content')

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">View User</h5>
                        <div class="card-body">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" id="show_users">
                                @csrf
                                @method('PATCH')
                                <div class="form-row">
                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                            <label class="mr-2 font-weight-bold">Name:</label>
                                            <p class="mb-0">{{ $user->name }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                            <label class="mr-2 font-weight-bold">Email:</label>
                                            <p class="mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                           {{-- {{ $user->user['name'] }} --}}
                                            <label class="mr-2 font-weight-bold">Department</label>
                                            <p class="mb-0">{{ ucfirst($user->user_type) }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                            <label class="mr-2 font-weight-bold">User Name:</label>
                                            <p class="mb-0">
                                                {{ $user->user_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
                                    <a href="{{ route('users') }}" class="btn btn-dark mr-3"
                                        style="bottom: 15px; right: 15px;" type="back" name="btn_bck">Back</a>
                                </div>

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
