<?php

namespace App\Http\Controllers\AuthUser;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskCategory;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function create(){
    $data['taskCategories'] = TaskCategory::pluck('name', 'id');
    return view('task.create', $data);
   }

   public function store(Request $request){
    
    $request->validate([
        'name'        => 'required|string|max:255',
        'category_id' => 'required',
    ],[],[
        'category_id' => 'category',
    ]);

    $task = new Task();
    $task->category_id = $request->input('category_id');
    $task->name = $request->input('name');
    $task->save();

    return redirect(route('task-boards'))->with('flash_success', 'Task created successfully.');
    
   }

   public function edit(Task $task){

    $data['task'] = $task;
    $data['taskCategories'] = TaskCategory::pluck('name', 'id');
    return view('task.edit', $data);
   }

   public function update(Request $request, Task $task){
 
    $request->validate([
        'name'        => 'required|string|max:255',
        'category_id' => 'required',
    ],[],[
        'category_id' => 'category',
    ]);

    $task->update([
        'name'        =>  $request->input('name'),
        'category_id' =>  $request->input('category_id'),
    ]);

    return redirect(route('task-boards'))->with('flash_success', 'Task updated created successfully.');
    
   }

   public function delete(Task $task)
   {
       $task->delete();
       return redirect()->back()->with('flash_success', 'Task deleted successfully.');
   }
}
