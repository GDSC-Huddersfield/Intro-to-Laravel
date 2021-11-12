<?php

use App\Models\Todo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ChangeTodoStatusController;

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
    return view('welcome',[
        'currentTodo' => Todo::where('done', false)->count(),
        'finishedTodo' => Todo::where('done', true)->count(),
    ]);
})->name('welcome');

Route::resource('todo', TodoController::class);
Route::get('/{todo}/change-staus', ChangeTodoStatusController::class)->name('status-update');
