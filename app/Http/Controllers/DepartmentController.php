<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class DepartmentController extends Controller
{
    public function index()
{
    // $tasks = Task::where('status', '!=', 2)->get();

    $departments = Department::where('status', '!=', 2)->get();

    // return response()->json($tasks);
    return view('department.index', compact('departments'));
}

    public function create()
    {
         $departments = Department::where('status', '!=', 2)->get();
        return view('department.create', compact('departments'));
    }

    // ['task_name', 'client_name', 'task_type', 'task_desc', 'task_content','task_status','assigned_to','created_by','updated_by','status'];
    public function store(Request $request)
    {
        // return  $request;
        $request->validate([
            'department_name' => 'required|string',
        ]);

        $userId = Auth::user()->id;

        // return $request->department_name;
        Department::create([
            'name' => $request->department_name,
            'created_by'=>$userId,
            'updated_by'=>$userId

        ]);

        return redirect()->route('departments')->with('success', 'Department is created successfully!');

    }

    public function edit($id)
    {
        $departments = Department::findOrFail($id);
        $departments = Department::where('status', '!=', 2)->get();

    // Pass the task and designers to the view
    return view('department.edit', compact('departments', 'departments'));
    }

    public function show($id)
    {
        // $task = Task::findOrFail($id);
        $departments = Department::findOrFail($id);
        $departments = Department::where('name',$departments->department_type)->get();



        // return $history;
        return view('todos.show', compact('departments','departments'));
    }

    public function update(Request $request, $department_id)
    {
        // return $department_id;
        $departments = Department::findOrFail($department_id);

        $updateData = [
            'name' => $request->departmentName_app,
        ];

        $updated=$departments->update($updateData);

        return redirect()->route('departments')->with('success', 'Department updated successfully!');
    }



    public function destroy($id)
    {
        $task = Department::findOrFail($id);


        $task->status = '2';


        $task->save();


        return redirect()->route('departments')->with('success', 'Department deleted successfully!');;
    }

}
