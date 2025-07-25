@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card">

                        <div class="card-header">
                            <button class="btn btn-primary addBtn" type="submit" name="">
                                Add Department</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="myTable" class="table table-striped table-bordered second" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Department Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($departments as $key => $department)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $department->name }}</td>
                                                <td>
                                                    @php
                                                        $userType = Auth::user()->user_type;
                                                    @endphp

                                                    {{-- Show edit/delete only for admin and manager --}}
                                                    @if (in_array($userType, ['admin', 'manager']))
                                                        <button type="button"
                                                            class="btn btn-link p-0 m-0 align-baseline editBtn mr-2"
                                                            data-id="{{ $department->id }}"
                                                            data-name="{{ $department->name }}" title="Edit Department">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <button type="button"
                                                            class="btn btn-link p-0 m-0 align-baseline deleteBtn mr-2"
                                                            data-id="{{ $department->id }}"
                                                            data-name="{{ $department->name }}" title="Delete Department">
                                                            <i class="fas fa-trash"></i>
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
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-xl" role="document">
                <form method="POST" id="editForm">
                    @csrf
                    @method('PATCH')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Department</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>

                        </div>
                        <div class="modal-body">

                            <input type="text" class="form-control" name="departmentName_app" id="departmentName_app">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="submitEdit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-xl" role="document">
                <form method="POST" id="addForm">
                    @csrf
                    @method('POST')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Department</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>

                        </div>
                        <div class="modal-body">

                            <input type="text" class="form-control" name="department_name" id="department_name"
                                value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="submitadd" class="btn btn-success">Add</button>
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
                $('#deleteForm').attr('action', '/department_destroy/' + taskId); // Update this route if needed
                $('#taskName').text(taskName); // Show task name in modal
                $('#deleteModal').modal('show'); // Open modal

            });

            $(document).on('click', '.editBtn', function() {

                var departmentId = $(this).data('id');
                var departmentName = $(this).data('name');

                // Set form action
                $('#editForm').attr('action', '/department/' + departmentId + '/update'); // Update this route if needed
                $('#departmentName_app').val(departmentName); // Show task name in modal
                $('#editModal').modal('show'); // Open modal
                //$('#editForm').submit();
            });

            $('#submitEdit').on('click', function() {
                $('#editForm').submit();
            });

            $(document).on('click', '.addBtn', function() {

                // Set form action
                $('#addForm').attr('action', '/department_store'); // Update this route if needed

                $('#addModal').modal('show'); // Open modal
                //$('#editForm').submit();
            });

            $('#submitadd').on('click', function() {
                $('#addForm').submit();
            });

            $('#myTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
            });
        </script>
    @endsection
