<?php

namespace App\Http\Controllers\AuthUser;

use App\Http\Controllers\Controller;
use App\Models\TaskCategory;

class TaskBoardController extends Controller
{
    public function taskBoard()
    {
        $data['taskCategories'] = TaskCategory::with('tasks')->get();
        return view('task-board', $data);
    }
}
