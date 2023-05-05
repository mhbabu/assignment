<?php

namespace App\Http\Controllers\AuthUser;

use App\Http\Controllers\Controller;
use App\Models\TaskCategory;
use Illuminate\Http\Request;

class TaskCategoryController extends Controller
{
   public function create(){
    return view('task-category.create');
   }

   public function store(Request $request){
    
    $request->validate([
        'name' => 'required|string|unique:task_categories,name|max:255'
    ]);

    $taskCategory = new TaskCategory();
    $taskCategory->name = $request->input('name');
    $taskCategory->save();

    return redirect(route('task-boards'))->with('flash_success', 'Task Category created successfully.');
    
   }

   public function edit(TaskCategory $taskCategory){

    $data['taskCategory'] = $taskCategory;
    return view('task-category.edit', $data);
   }

   public function update(Request $request, TaskCategory $taskCategory){
 
    $request->validate([
        'name' => 'required|string|unique:task_categories,name,'.$taskCategory->id,
    ]);

    $taskCategory->update(['name' =>  $request->input('name')]);

    return redirect(route('task-boards'))->with('flash_success', 'Task updated created successfully.');
    
   }

   public function delete(TaskCategory $taskCategory)
   {
       $taskCategory->delete();
       return redirect()->back()->with('flash_success', 'Task Category deleted successfully.');
   }
}
