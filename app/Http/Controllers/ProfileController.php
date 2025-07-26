<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;



class ProfileController extends Controller
{
    public function index()
{
    // $tasks = Task::where('status', '!=', 2)->get();

    $users = User::where('status', '!=', 2)->get();

    // return response()->json($tasks);
    return view('profile.index', compact('users'));
}

    public function create()
    {
         $departments = Department::where('status', '!=', 2)->get();

        return view('profile.create', compact('departments'));
    }

    // ['task_name', 'client_name', 'task_type', 'task_desc', 'task_content','task_status','assigned_to','created_by','updated_by','status'];
    public function store(Request $request)
    {
        // return  $request;
        $request->validate([
            'profile_name' => 'required|string|max:255',
            'email' => 'required|string',
            'user_type' => 'required|string',
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        $userId = Auth::user()->id;


        User::create([
            'name' => $request->profile_name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'user_name' => $request->user_name,
            'password' =>Hash::make($request->password),
            'created_by'=>$userId,
            'updated_by'=>$userId

        ]);

        return redirect()->route('users')->with('success', 'User Profile is created successfully!');

    }

    public function profile_edit($id)
    {
        $users = User::findOrFail($id);
        $departments = Department::where('status', '!=', 2)->get();

    // Pass the task and designers to the view
    return view('profile.edit', compact('users', 'departments'));
    }

    public function show($id)
    {
        // $task = Task::findOrFail($id);
        $user = User::findOrFail($id);
        $departments = Department::where('name',$user->user_type)->get();



        // return $history;
        return view('profile.show', compact('user','departments'));
    }

    public function update(Request $request, $user_id)
    {
        $users = User::findOrFail($user_id);

        $userType = Auth::user()->user_type;

         $userId = Auth::user()->id;

         if ($request->filled('password')) {
            $password = Hash::make($request->password);
         }
         else{
            $password=$request->password_old;
         }
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'user_name' => $request->user_name,
            'password' => $password,
        ];

        $updated=$users->update($updateData);

        return redirect()->route('users')->with('success', 'Profile updated successfully!');
    }

    public function change_password($id)
    {
        $users = User::findOrFail($id);

    // Pass the task and designers to the view
    return view('profile.change_password', compact('users'));
    }

       public function update_password(Request $request, $user_id)
    {

        $users = User::findOrFail($user_id);


        $userType = Auth::user()->user_type;

         $userId = Auth::user()->id;

        //  return $request->filled('confirm_password');
         if ($request->filled('confirm_password')) {
            $password = Hash::make($request->confirm_password);
         }
         else{
            $password=$request->password_old;
         }
        $updateData = [
            'password' => $password,
        ];

        $updated=$users->update($updateData);

        return redirect()->route('tasks')->with('success', 'Password updated successfully!');
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);


        $user->status = '2';


        $user->save();


        return redirect()->route('users')->with('success', 'User deleted successfully!');;
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

    public function updatePassword(Request $request)
{
    // ✅ Validate input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
        'token' => 'required'
    ]);

    // $reset = DB::table('password_resets')
    //     ->where('email', $request->email)
    //     ->where('token', $request->token)
    //     ->first();

    // if (!$reset) {
    //     return back()->withErrors(['token' => 'Invalid or expired token.']);
    // }

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'No user found with that email.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    // ✅ Delete the reset token after successful password reset
    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->route('login')->with('success', 'Password has been reset successfully.');
}
}
