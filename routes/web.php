<?php

use App\Http\Controllers\AuthUser\TaskCategoryController;
use App\Http\Controllers\AuthUser\TaskController;
use App\Http\Controllers\AuthUser\TaskBoardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    if (auth()->user())
        return redirect(route('task-boards'));

    return redirect(route('login'));
});

Auth::routes();

Route::group(['prefix' => 'auth-user','middleware' => ['web','auth']], function() {
    Route::get('task-boards', [TaskBoardController::class, 'taskBoard'])->name('task-boards');
    Route::get('task-categories/delete/{taskCategory}', [TaskCategoryController::class, 'delete']);
    Route::resource('task-categories', TaskCategoryController::class)->only(['create', 'store', 'edit', 'update']);
    Route::get('tasks/delete/{task}', [TaskController::class, 'delete']);
    Route::resource('tasks', TaskController::class)->only(['create', 'store', 'edit', 'update']);
});