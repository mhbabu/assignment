<?php

namespace App\Http\Controllers\AuthUser;

use App\Http\Controllers\Controller;
use App\Models\TaskCategory;
use App\Models\User;

class TaskBoardController extends Controller
{
    public function allUsers()
    {
        $data['users'] = User::get();
        return view('user.user-list', $data);
    }

    public function taskBoard()
    {
        $data['taskCategories'] = TaskCategory::with('tasks')->get();
        return view('task-board', $data);
    }
}
