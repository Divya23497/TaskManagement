<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;


class ReportController extends Controller
{

  public function alltasks()
{
    $user = Auth::user();

    $alltasks = in_array($user->user_type, ['admin', 'manager']) ?
        Task::where('status', '!=', 2)->get() :
        Task::where('status', '!=', 2)->where('assigned_to', $user->id)->get();

    $users = User::where('user_type', 'designer')->get();

    foreach ($alltasks as $task) {
        $taskUser = User::find($task->assigned_to);
        $task->assigned_username = $taskUser->name ?? '';
    }

    return view('reports.all_tasks', compact('alltasks', 'users'));
}

public function overdue_tasks()
{
    $user = Auth::user();

    $query = Task::where('status', '!=', 2)->whereNotIn('task_status', ['Completed', 'Cancelled']);
    if (!in_array($user->user_type, ['admin', 'manager'])) {
        $query->where('assigned_to', $user->id);
    }
    $alltasks = $query->get();

    $users = User::where('user_type', 'designer')->get();
    $curr_date = Carbon::now();

    foreach ($alltasks as $task) {
        $taskUser = User::find($task->assigned_to);
        $task->assigned_username = $taskUser->name ?? '';

        $end_date = Carbon::parse($task->end_date);
        if ($end_date->lt($curr_date)) {
            $task->overdue_days = $end_date->diffInDays($curr_date);
        }
    }

    return view('reports.overdue_tasks', compact('alltasks', 'users'));
}

public function completed_tasks()
{
    $user = Auth::user();

    $query = Task::where('status', '!=', 2)->where('task_status', 'Completed');
    if (!in_array($user->user_type, ['admin', 'manager'])) {
        $query->where('assigned_to', $user->id);
    }
    $alltasks = $query->get();

    $users = User::where('user_type', 'designer')->get();
    $curr_date = Carbon::now();

    foreach ($alltasks as $task) {
        $taskUser = User::find($task->assigned_to);
        $task->assigned_username = $taskUser->name ?? '';

        $completed_date = Carbon::parse($task->completion_time);
        $task->duration_days = $completed_date->diffInDays($curr_date);
    }

    return view('reports.completed_tasks', compact('alltasks', 'users'));
}

public function emptask_summary()
{
    $user = Auth::user();

    if (!in_array($user->user_type, ['admin', 'manager'])) {
        abort(403, 'Access denied');
    }

    $users = User::where('status', '!=', 2)->get();
    $curr_date = Carbon::now();

    foreach ($users as $u) {
        $u->total_tasks = Task::where('assigned_to', $u->id)->count();
        $u->comp_tasks = Task::where('assigned_to', $u->id)->where('task_status', 'Completed')->count();
        $u->pending_tasks = Task::where('assigned_to', $u->id)->where('task_status', 'Pending')->count();
        $u->overdue_tasks = Task::where('assigned_to', $u->id)
            ->whereIn('task_status', ['Completed', 'Cancelled'])
            ->whereDate('completion_time', '<', $curr_date)
            ->count();
    }

    return view('reports.emptask_summary', compact('users'));
}

public function pending_tasks()
{
    $user = Auth::user();

    $query = Task::where('status', '!=', 2)->whereNotIn('task_status', ['Completed', 'Cancelled']);
    if (!in_array($user->user_type, ['admin', 'manager'])) {
        $query->where('assigned_to', $user->id);
    }
    $alltasks = $query->get();

    $users = User::where('status', '!=', 2)->get();

    foreach ($alltasks as $task) {
        $taskUser = User::find($task->assigned_to);
        $task->assigned_username = $taskUser->name ?? '';
    }

    return view('reports.pending_tasks', compact('alltasks', 'users'));
}

public function estimated()
{
    $user = Auth::user();

    $query = Task::where('status', '!=', 2)->where('task_status', 'Completed');
    if (!in_array($user->user_type, ['admin', 'manager'])) {
        $query->where('assigned_to', $user->id);
    }
    $alltasks = $query->get();

    $users = User::where('status', '!=', 2)->get();

    foreach ($alltasks as $task) {
        $taskUser = User::find($task->assigned_to);
        $task->assigned_username = $taskUser->name ?? '';

        $start = Carbon::parse($task->start_date);
        $end = Carbon::parse($task->end_date);
        $completion = $task->completion_time ? Carbon::parse($task->completion_time) : null;

        $task->estimated = $start->diffInDays($end) + 1;
        $task->actual = $completion ? $start->diffInDays($completion) + 1 : null;
        $task->variance = $task->actual !== null ? $task->actual - $task->estimated : null;
    }

    return view('reports.estimated', compact('alltasks', 'users'));
}

}
