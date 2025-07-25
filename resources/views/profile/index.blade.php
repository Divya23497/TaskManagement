@extends('layouts.app')

@section('title', 'user Management System')

@section('content')
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card">

                        <div class="card-header">
                            <a href="{{ route('profile.create') }}"><button class="btn btn-primary" type="submit"
                                    name="">
                                    Add User</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="myTable" class="table table-striped table-bordered second" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>User Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}
                                                </td>
                                                <td>{{ $user->user_type }}</td>
                                                <td>
                                                    @php
                                                        $currentUserType = Auth::user()->user_type;
                                                    @endphp

                                                    {{-- Allow all to view --}}
                                                    <a href="{{ route('profile.show', $user->id) }}" title="View user"
                                                        class="mr-2">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    {{-- Allow only admin and manager to edit/delete --}}
                                                    @if (in_array($currentUserType, ['admin', 'manager']))
                                                        <a href="{{ route('profile.edit', $user->id) }}" title="Edit user"
                                                            class="mr-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button type="button"
                                                            class="btn btn-link p-0 m-0 align-baseline deleteBtn mr-2"
                                                            data-id="{{ $user->id }}" data-name="{{ $user->user_name }}"
                                                            title="Delete user">
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
                            Are you sure you want to delete <strong id="userName"></strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
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
                            Are you sure you want to Approve <strong id="userName_app"></strong>?
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
                var userId = $(this).data('id');
                var userName = $(this).data('name');

                // Set form action
                $('#deleteForm').attr('action', '/user_destroy/' + userId); // Update this route if needed
                $('#userName').text(userName); // Show user name in modal
                $('#deleteModal').modal('show'); // Open modal

            });

            $(document).on('click', '.approvalBtn', function() {

                var userId = $(this).data('id');
                var userName = $(this).data('name');

                // Set form action
                $('#approvalForm').attr('action', '/user_approval/' + userId); // Update this route if needed
                $('#userName_app').text(userName); // Show user name in modal
                $('#approvalModal').modal('show'); // Open modal

            });



            $('#myTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
            });
        </script>
    @endsection
