<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;


class TaskController extends Controller
{
public function index()
{
    $user = Auth::user();

    // If admin, show all designers' tasks
        if (in_array($user->user_type, ['admin', 'manager'])) {
            // Show all tasks
            $tasks = Task::where('status', '!=', 2)->get();
            $users = User::where('user_type', 'designer')->get();
        } else {
            // Show only tasks assigned to logged-in user
            $tasks = Task::where('status', '!=', 2)
                        ->where('assigned_to', $user->id)
                        ->get();
            $users = collect(); // empty
        }
    // Add assigned user name (for display)
    foreach ($tasks as $task) {
        $assignedUser = User::find($task->assigned_to);
        $task->assigned_username = $assignedUser->name ?? '-';
    }

    return view('todos.index', compact('tasks', 'users'));
}

    public function create()
    {
         $users = User::where('user_type', 'designer')->get();
        return view('todos.create', compact('users'));
    }

    // ['task_name', 'client_name', 'task_type', 'task_desc', 'task_content','task_status','assigned_to','created_by','updated_by','status'];
    public function store(Request $request)
    {
        // return  $request;
        $request->validate([
            'task_title' => 'required|string|max:255',
            'assign_name' => 'required|string',
            'priority' => 'required|string',
        ]);

        $userId = Auth::user()->id;

        if($request->status=='Completed'){
            $completion_time=Carbon::now()->format('Y-m-d H:i:s');
        }
        else{
            $completion_time=null;
        }
        Task::create([
            'task_name' => $request->task_title,
            'assigned_to' => $request->assign_name,
            'task_type' => $request->priority,
            'task_desc' => $request->desc,
            // 'start_date' => date('d-m-Y', strtotime($request->sdate)),
            // 'end_date' => date('d-m-Y', strtotime($request->edate)),
             'start_date' => $request->sdate,
            'end_date' => $request->edate,
            'task_status' => $request->status,
            // 'assigned_to' => '0',
            'completion_time'=>$completion_time,
            'created_by'=>$userId,
            'updated_by'=>$userId

        ]);

        $managers = User::where('user_type', 'manager')->get();

        $task = Task::where('task_name',  $request->task_title)->first();


        if($task){
            TaskHistory::create([
            'task_id' => $task->id,
            'task_status' => $task->task_status,
            // 'assigned_to' => '0',
            'created_by'=>$userId ,
            'updated_by'=>$userId

        ]);
        }

        // return $managers->id;

        $message = 'Task ' . $task->task_name . ' is Created by an executive "' . Auth::user()->name . '".';

        $notifications = [];

        foreach ($managers as $manager) {
            $notifications[] = [
                'user_id' =>Auth::user()->id, // The manager's user ID
                'task_id' => $task->id, // The task ID
                'assigned_to' => $manager->id, // The user the task is assigned to
                'message' => $message, // The notification message
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // return $notifications;

        Notification::insert($notifications);

        return redirect()->route('tasks')->with('success', 'Task created successfully!');

    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::where('user_type', 'designer')->get();

    // Pass the task and designers to the view
    return view('todos.edit', compact('task', 'users'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        $history = TaskHistory::where('task_id',$id)->get();


        $assigned_name=User::where('id',$task->assigned_to)->first();

        $task->assigned_username =$assigned_name->name;

        $statusProgress = [
            'Not Started' => 0,
            'On Hold'     => 10,
            'In Progress' => 50,
            'Review'      => 75,
            'Rework'      => 60,
            'Completed'   => 100,
            'Cancelled'   => 0,
        ];

        foreach ($history as $log) {
            $log->status_progress = $statusProgress[$log->task_status] ?? 0;
        }
        // return $history;
        return view('todos.show', compact('task','history'));
    }


    public function update(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $userType = Auth::user()->user_type;

        if($request->status=='Completed'){
            $completion_time=Carbon::now()->format('Y-m-d H:i:s');
        }
        else{
            $completion_time=null;
        }

        $updateData = [
            'task_name' => $request->task_title,
            'assigned_to' => $request->assign_name,
            'task_type' => $request->priority,
            'task_desc' => $request->desc,
            'start_date' => $request->sdate,
            'end_date' => $request->edate,
            'task_status' => $request->status,
            'completion_time'=>$completion_time,
        ];

        if ($userType == 'executive') {
            $updateData['task_status'] = $request->status;
            $message = 'Task ' . $task->task_name . ' status has been updated to ' . $request->status . '.';
        }

        if ($userType == 'manager') {
            // return $request->appstatus;
            $updateData['approval_status'] = $request->appstatus;
            $updateData['assigned_to'] = $request->assign_name;
            $message = 'Task ' . $task->task_name . ' status has been updated to ' . $request->appstatus .'.';
        }

        if ($userType == 'designer') {
            $updateData['task_status'] = $request->status;
            $message = 'Task ' . $task->task_name . ' status has been updated to ' . $request->status . '.';
        }


        $updated=$task->update($updateData);

            $userId = Auth::user()->id;

            TaskHistory::create([
            'task_id' => $taskId,
            'task_status' => $request->status,
            // 'assigned_to' => '0',
            'created_by'=>$userId,
            'updated_by'=>$userId

        ]);


    Notification::create([
        'user_id' =>Auth::user()->id,
        'task_id' => $taskId,
        'assigned_to' => $request->assign_name,
        'message' => $message,
    ]);


        return redirect()->route('tasks')->with('success', 'Task updated successfully!');
    }

    public function updateStatus(Request $request)
{

    $validated = $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'status' => 'required|string',
    ]);


    $task = Task::find($request->task_id);

    if($request->status =='Approved' || $request->status =='Not Approved'){
        $task->approval_status = $request->status;
    }
    else{
        $task->task_status = $request->status;

    }
    $task->save();

    $message = 'Task ' . $task->task_name . ' status has been updated to ' . $request->status . '.';

    // here I'm sending it to the user who owns the task or related user
    Notification::create([
        'user_id' =>Auth::user()->id, // The user who is assigned to this task
        'task_id' => $task->id,
        'assigned_to' => $task->assigned_to,
        'message' => $message,
    ]);

    // Update the task status


    return response()->json(['success' => true]);
}

    public function destroy($id)
    {
        $task = Task::findOrFail($id);


        $task->status = '2';


        $task->save();


        return redirect()->route('tasks')->with('success', 'Task deleted successfully!');;
    }
    public function task_approval($id)
    {
        $task = Task::findOrFail($id);


        $task->approval_status = 'Approved';


        $task->save();


        return redirect()->route('tasks')->with('success', 'Task Approved successfully!');;
    }
    public function updateAssignedTo(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'user_id' => 'required|exists:users,id',
        ]);


        $task = Task::find($validated['task_id']);

        // return $validated['user_id'];
        $task->assigned_to = $validated['user_id'];
        // return $task;
        $task->save();

        // return $managers->id;

        $message = 'Task ' . $task->task_name . ' is Assigned by manager "' . Auth::user()->name . '".';



            $notifications = [
                'user_id' =>Auth::user()->id, // The manager's user ID
                'task_id' => $request->task_id, // The task ID
                'assigned_to' => $task->assigned_to, // The user the task is assigned to
                'message' => $message, // The notification message
                'created_at' => now(),
                'updated_at' => now(),
            ];


        // return $notifications;

        Notification::insert($notifications);


        return response()->json(['message' => 'Task Assigned Successfully']);
    }
}
