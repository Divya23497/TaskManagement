@extends('layouts.app')

@section('title', 'Task Management System')

@section('content')
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">

            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card">

                        <h5 class="card-header">Completed Tasks</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                               <div class="row mb-3">
                                    <div class="col d-flex justify-content-end">
                                        <div class="col-md-3">
                                            <label>Filter By Date</label>
                                            <select id="dateRangeFilter" class="form-control">
                                                <option value="">All</option>
                                                <option value="this_week">This Week</option>
                                                <option value="this_month">This Month</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <table id="myTable" class="table table-striped table-bordered second" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Task Name</th>
                                            <th>Assigned To</th>
                                            <th>Completed Date</th>
                                            <th>Duration(Days)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alltasks as $key => $task)

                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $task->task_name }}</td>
                                                 <td>{{ $task->assigned_username }}</td>
                                                <td>{{ $task->completion_time ? date('d-m-Y', strtotime($task->completion_time)) : '' }}
                                                </td>
                                               <td>{{ $task->duration_days }}</td>
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
