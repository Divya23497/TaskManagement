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
                        <h5 class="card-header">Add Tasks</h5>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('tasks.store') }}" method="post"
                                enctype="multipart/form-data" id="add_tasks">
                                @csrf
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom03">Task Title</label>
                                        <input type="text" class="form-control" name="task_title" id="task_title"
                                            value="" placeholder="Task Title" />
                                        {{-- <select class="form-control" name="fname" required>
                                            <option value="">Select Name</option>

                                            </option>

                                        </select> --}}
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02"> Task Priority</label>
                                        <select class="form-control" name="priority" required>
                                            <option value="">Select Priority</option>
                                            <option value="high">High</option>
                                            <option value="medium">Medium</option>
                                            <option value="low">Low</option>
                                            </option>

                                        </select>

                                        <div class="valid-feedback"></div>
                                    </div>


                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02"> Assign To</label>

                                        <select class="form-control" name="assign_name" id="assign_name" required>
                                            <option value="">Select AssignTo</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ ucfirst($user->name) }}
                                                </option>
                                            @endforeach
                                            </option>

                                        </select>
                                        <div class="valid-feedback"></div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">Assign Date</label>
                                        <input type="date" name="sdate" id="sdate" class="form-control mb-1"
                                            placeholder="">
                                        <div class="valid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">End Date</label>
                                        <input type="date" name="edate" id="edate" class="form-control mb-1"
                                            placeholder="">
                                        <div class="valid-feedback"></div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">Task Status</label>

                                        <select class="form-control" name="status" required>
                                            <option value="">Select status</option>
                                            <option value="Not Started">Not Started</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="On Hold">On Hold</option>
                                            <option value="Rework">Rework</option>
                                            <option value="Review">Review</option>
                                            </option>

                                        </select>
                                        <div class="valid-feedback"></div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">File</label>
                                        <input type="file" name="file" id="file" class="form-control"
                                            style="border: none; box-shadow: none;" multiple  onchange="previewFiles(event)">
                                        <div class="valid-feedback"></div>

                                        <div id="previewArea" style="display: flex; flex-wrap: wrap; gap: 1rem;"></div>

                                        <img id="imagePreview"
                                            style="max-width: 200px; display: none; border: 1px solid #ccc; padding: 5px; border-radius: 8px;">

                                        <embed id="pdfPreview" type="application/pdf" width="50%" height="150px"
                                            style="display: none; border: 1px solid #ccc; margin-top: 10px;">

                                        <a id="downloadLink" href="#" target="_blank"
                                            style="display: none; margin-top: 10px;"
                                            class="btn btn-outline-secondary">Download File</a>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="validationCustom02">Task Description</label>
                                        <textarea name="desc" id="desc" row="5" class="form-control mb-1" placeholder=""></textarea>
                                        <div class="valid-feedback"></div>
                                    </div>



                                </div>
                                <br>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end">

                                    <a href="{{ route('tasks') }}" class="btn btn-dark mr-3" style="bottom: 15px; right: 15px;" type="back"
                                        name="btn_bck">Back</a>

                                    <button class="btn btn-primary " style="bottom: 15px; right: 15px;" type="submit"
                                        name="btn_save">Add Task</button>
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
