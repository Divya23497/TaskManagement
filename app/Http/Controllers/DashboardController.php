<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'total' => Task::count(),
            'completed' => Task::where('status', 'Completed')->count(),
            'pending' => Task::whereNotIn('status', ['Completed','Cancelled'])->count(),
            'overdue' => Task::where('end_date', '<', now())->where('status', '!=', 'Completed')->count(),
            'tasks' => Task::latest()->take(5)->get(),
        ]);
    }
}

