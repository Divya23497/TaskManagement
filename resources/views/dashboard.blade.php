@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">

                        <h5 class="card-header">Dashboard</h5>

                    <div class="card-body">
                        {{-- Status Cards --}}
                        <div class="row text-center">
                            <div class="col-md-3 mb-3">
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h5>Total Tasks</h5>
                                        <h3 class="text-primary">{{ $total }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <h5>Completed</h6>
                                        <h3 class="text-success">{{ $completed }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card border-warning">
                                    <div class="card-body">
                                        <h5>Pending</h6>
                                        <h3 class="text-warning">{{ $pending }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card border-danger">
                                    <div class="card-body">
                                        <h5>Overdue</h6>
                                        <h3 class="text-danger">{{ $overdue }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Recent Tasks Table --}}
                        <div class="mt-4">
                            <h5><i class="fas fa-tasks me-2 text-primary mr-2"></i>Recent Tasks</h5>
                            <table class="table table-bordered table-hover mt-2">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tasks as $task)
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
                                            <td>{{ $task->task_name }}</td>
                                            <td>
                                                    <span class="badge {{ $statusClass }}">{{ $task->task_status }}</span>
                                                </td>
                                            <td>{{ \Carbon\Carbon::parse($task->end_date)->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No tasks available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Create Button --}}
                        <div class="text-center mt-4">
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary"> Create New Task</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
