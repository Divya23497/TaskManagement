@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card">

                        <h5 class="card-header">Employee Task Summary</h5>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="myTable" class="table table-striped table-bordered second" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Total Tasks</th>
                                            <th>Completed</th>
                                            <th>Pending</th>
                                            <th>Overdue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                        @if(($user->total_tasks ?? 0) != 0 || ($user->comp_tasks ?? 0) != 0 ||($user->pending_tasks ?? 0) != 0 ||($user->overdue_tasks ?? 0) != 0)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{$user->total_tasks}}</td>
                                                 <td>{{ $user->comp_tasks }}</td>
                                                <td>{{ $user->pending_tasks }}</td>
                                               <td>{{ $user->overdue_tasks }}</td>
                                            </tr>
                                            @endif
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




        <!-- DataTables JS -->

        {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <!-- Bootstrap 4 JS (required for modal) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>




            // $('#myTable').DataTable({
            //     responsive: true,
            //     pageLength: 10,
            //     lengthMenu: [5, 10, 25, 50],
            // });
        </script>

        <script>
$(document).ready(function () {

    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        // alertr("hi");
        let filter = $('#dateRangeFilter').val();
        let completedDate = data[3]; // index of "Completed Date" column

// alert(completedDate);
        if (!completedDate) return false;

        let taskDate = moment(completedDate, 'DD-MM-YYYY');
        let today = moment();

        if (filter === 'this_week') {
            alert("hi");
            let startOfWeek = today.clone().startOf('isoWeek');
            let endOfWeek = today.clone().endOf('isoWeek');
            return taskDate.isBetween(startOfWeek, endOfWeek, null, '[]');
        }

        if (filter === 'this_month') {
            let startOfMonth = today.clone().startOf('month');
            let endOfMonth = today.clone().endOf('month');
            return taskDate.isBetween(startOfMonth, endOfMonth, null, '[]');
        }

        return true; // Default if "All"
    });

    let table = $('#myTable').DataTable();

    // Redraw table on filter change
    $('#dateRangeFilter').on('change', function () {
        table.draw();
    });
});
</script>
    @endsection
