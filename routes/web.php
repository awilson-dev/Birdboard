<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectInvitationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectTasksController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/projects');
});

Route::get('/home', function () {
    return redirect('/projects');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('projects', ProjectsController::class);

    Route::post('/projects/{project}/tasks', [ProjectTasksController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [ProjectTasksController::class, 'update']);

    Route::post('/projects/{project}/invitations', [ProjectInvitationsController::class, 'store']);
    Route::delete('/projects/{project}/invitations/{user}', [ProjectInvitationsController::class, 'destroy']);

    // Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Auth::routes();
