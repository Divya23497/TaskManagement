@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">View Task</h5>
                        <div class="card-body">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" id="show_tasks">
                                @csrf
                                @method('PATCH')
                                <div class="form-row">
                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                            <label class="mr-2 font-weight-bold">Task Title:</label>
                                            <p class="mb-0">{{ $task->task_name }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                            <label class="mr-2 font-weight-bold">Task Priority:</label>
                                            <p class="mb-0">{{ ucfirst($task->task_type) }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                           {{-- {{ $task->user['name'] }} --}}
                                            <label class="mr-2 font-weight-bold">Assign To:</label>
                                            <p class="mb-0">{{ $task->assigned_username ?? 'Unassigned' }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                            <label class="mr-2 font-weight-bold">Assign Date:</label>
                                            <p class="mb-0">
                                                {{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('d-m-Y') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                            <label class="mr-2 font-weight-bold">End Date:</label>
                                            <p class="mb-0">
                                                {{ $task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('d-m-Y') : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <div class="d-flex">
                                            <label class="mr-2 font-weight-bold">Task Status:</label>
                                            <p class="mb-0">
                                                @php
                                                    $badgeClasses = [
                                                        'Not Started' => 'badge-secondary',
                                                        'On Hold' => 'badge-danger',
                                                        'In Progress' => 'badge-dark',
                                                        'Review' => 'badge-primary',
                                                        'Completed' => 'badge-success',
                                                        'Cancelled' => 'badge-danger',
                                                        'Rework'      => 'badge-warning',
                                                    ];

                                                    $badgeClass =
                                                        $badgeClasses[$task->task_status] ?? 'badge-secondary';
                                                @endphp

                                                <span class="badge {{ $badgeClass }}">
                                                    {{ $task->task_status }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="d-flex">
                                            <label class="mr-2 font-weight-bold">Task Description:</label>
                                            <p class="mb-0">{{ $task->task_desc }}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h5 class="mt-4 mb-3">Task History</h5>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Remarks</th>

                                                <th>Task Progress</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($history as $index => $log)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $log->task_status }}</td>

                                                    <td>
                                                        <div>Task Progress: {{ $log->status_progress }}%</div>
                                                        <div class="progress" style="height: 15px;">
                                                            <div class="progress-bar
                                                                        @if ($log->status_progress < 30) bg-danger
                                                                        @elseif($log->status_progress < 70)
                                                                            bg-warning
                                                                        @elseif($log->status_progress < 100)
                                                                            bg-info
                                                                        @else
                                                                            bg-success @endif"
                                                                style="width: {{ $log->status_progress }}%;">
                                                                {{-- {{ $log->status_progress }}% --}}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($log->updated_at)->format('d-m-Y h:i A') }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No history available.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>


                                <br>
                                <input type="hidden" class="form-control" name="appstatus" id="appstatus"
                                    value="{{ $task->approval_status }}" />
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
                                    <a href="{{ route('tasks') }}" class="btn btn-dark mr-3"
                                        style="bottom: 15px; right: 15px;" type="back" name="btn_bck">Back</a>
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
