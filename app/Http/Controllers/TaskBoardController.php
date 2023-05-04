<?php

namespace App\Http\Controllers;

use App\Models\TaskCategory;
use Illuminate\Http\Request;

class TaskBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function taskBoard()
    {
        $data['taskCategories'] = TaskCategory::with('tasks')->where('created_by','=', auth()->user()->id)->get();
        return view('task-board', $data);
    }
}
