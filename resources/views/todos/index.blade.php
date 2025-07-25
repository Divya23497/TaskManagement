@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card">

                        <div class="card-header">
                            <a href="{{ route('tasks.create') }}"><button class="btn btn-primary" type="submit" name="">
                                    Add
                                    Tasks</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="myTable" class="table table-striped table-bordered second" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Task Name</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Task Type</th>
                                            <th>Assigned To</th>

                                            <th>Approval Status</th>
                                            <th>Task Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $key => $task)
                                            @php
                                                $statusBadgeClasses = [
                                                    'Not Started' => 'badge-secondary',
                                                    'On Hold' => 'badge-dark',
                                                    'In Progress' => 'badge-info',
                                                    'Review' => 'badge-primary',
                                                    'Completed' => 'badge-success',
                                                    'Cancelled' => 'badge-danger',
                                                    'Rework' => 'badge-warning',
                                                ];

                                                $statusClass = $statusBadgeClasses[$task->task_status] ?? 'badge-light';
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $task->task_name }}</td>
                                                <td>{{ $task->start_date ? date('d-m-Y', strtotime($task->start_date)) : '' }}
                                                </td>
                                                <td>{{ $task->end_date ? date('d-m-Y', strtotime($task->end_date)) : '' }}
                                                </td>
                                                <td>{{ $task->task_type }}</td>
                                                <td>{{ $task->assigned_username }}</td>
                                                <td>
                                                    @if ($task->approval_status != 'Not Approved')
                                                        <button type="button" class="badge badge-success"
                                                            data-toggle="modal"
                                                            data-target="#statusModal{{ $task->id }}">
                                                            Approved
                                                        </button>
                                                    @else
                                                        <button type="button" class="badge badge-danger"
                                                            data-toggle="modal"
                                                            data-target="#statusModal{{ $task->id }}">
                                                            Not Approved
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge {{ $statusClass }}">{{ $task->task_status }}</span>
                                                </td>




                                                <td>
                                                    <a href="{{ route('tasks.edit', $task->id) }}" title="Edit Task"
                                                        class="mr-2"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('tasks.show', $task->id) }}" title="View Task"
                                                        class="mr-2"><i class="fas fa-eye"></i></a>
                                                    <button type="button"
                                                        class="btn btn-link p-0 m-0 align-baseline deleteBtn mr-2"
                                                        data-id="{{ $task->id }}" data-name="{{ $task->task_name }}"
                                                        title="Delete Task">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    @if ($task->approval_status == 'Not Approved')
                                                    <button class="btn btn-link p-0 m-0 align-baseline approvalBtn" data-id="{{ $task->id }}"
                                                        data-name="{{ $task->task_name }}">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end data table  -->
                <!-- ============================================================== -->
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Delete</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>

                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete <strong id="taskName"></strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form method="POST" id="approvalForm">
                    @csrf
                    @method('PATCH')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Status Approval</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>

                        </div>
                        <div class="modal-body">
                            Are you sure you want to Approve <strong id="taskName_app"></strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Approve</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- DataTables JS -->

        {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Bootstrap 4 JS (required for modal) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Handle delete button click
            $(document).on('click', '.deleteBtn', function() {
                var taskId = $(this).data('id');
                var taskName = $(this).data('name');

                // Set form action
                $('#deleteForm').attr('action', '/task_destroy/' + taskId); // Update this route if needed
                $('#taskName').text(taskName); // Show task name in modal
                $('#deleteModal').modal('show'); // Open modal

            });

            $(document).on('click', '.approvalBtn', function() {

                var taskId = $(this).data('id');
                var taskName = $(this).data('name');

                // Set form action
                $('#approvalForm').attr('action', '/task_approval/' + taskId); // Update this route if needed
                $('#taskName_app').text(taskName); // Show task name in modal
                $('#approvalModal').modal('show'); // Open modal

            });



            $('#myTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
            });
        </script>
    @endsection
