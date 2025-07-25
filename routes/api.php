<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/task_add', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/task_store', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/task_edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::patch('/task/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/task_show/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::delete('/task_destroy/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/tasks/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::post('/tasks/update-assigned-to', [TaskController::class, 'updateAssignedTo']);
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::get('/notifications/fetch', [NotificationController::class, 'getNotificationsByAssignedTo']);


// Route::post('/tasks/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');



Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login_welcome', [LoginController::class, 'login'])->name('login_welcome');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
