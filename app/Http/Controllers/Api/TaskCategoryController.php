<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskCategoryResource;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class TaskCategoryController extends Controller{

    public function index(){
        $taskCategories   = TaskCategory::all();

        if ($taskCategories->count() == 0) {
            return response()->json(['data' => []], 404);
        }

        $data = TaskCategoryResource::collection($taskCategories);
        return response(['data' => $data], Response::HTTP_OK);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:task_categories,name|max:255'
        ]);

        if ($validator->fails()) { 
            $errors = $validator->errors(); 
            return response()->json(['error' => $errors], 400);    
        } 

        $taskCategory = TaskCategory::create($request->all());
        return response(['message' =>'Task Category created successfully','data' => new TaskCategoryResource($taskCategory)], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $taskCategory = TaskCategory::find($id);

        if (empty($taskCategory)) {
            return response()->json([
                'status' => false,
                'message' => 'Item not found'
            ], 400);
        }
        return response(['data' => new TaskCategoryResource($taskCategory)], Response::HTTP_OK);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:task_categories,name,'.$id
        ]);

        if ($validator->fails()) { 
            $errors = $validator->errors(); 
            return response()->json(['error' => $errors], 400);    
        }

        $taskCategory = TaskCategory::find($id);
        
        if (empty($taskCategory)) {
            return response()->json([
                'status' => false,
                'message' => 'Item not found'
            ], 400);
        }

        $taskCategory->update(['name'=> $request->input('name')]);
        
        return response([
            'message' => 'Task Category updated successfully',
            'data' => new TaskCategoryResource($taskCategory)
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $taskCategory = TaskCategory::find($id);
        
        if (empty($taskCategory)) {
            return response()->json([
                'status' => false,
                'message' => 'Item not found'
            ], 400);
        }

        $taskCategory->delete();

        return response([
            'message' => 'Task Category deleted successfully',
        ], Response::HTTP_OK);

    }


}