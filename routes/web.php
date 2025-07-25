<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\ForgotPasswordController;


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
// Route::get('/', [TaskController::class, 'index'])->name('tasks');

// Route::get('/', function () {
//     return view('home');
// });



Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
Route::get('/task_add', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/task_store', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/task_edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::patch('/task/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/task_show/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::delete('/task_destroy/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::patch('/task_approval/{id}', [TaskController::class, 'task_approval'])->name('tasks.task_approval');
Route::post('/tasks/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::post('/tasks/update-assigned-to', [TaskController::class, 'updateAssignedTo']);
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::get('/notifications/fetch', [NotificationController::class, 'getNotificationsByAssignedTo']);

// User Profile
Route::get('/profile_edit/{id}', [ProfileController::class, 'profile_edit'])->name('profile.edit');

Route::get('/change_password/{id}', [ProfileController::class, 'change_password'])->name('password.edit');
Route::patch('/change_password/{id}/update', [ProfileController::class, 'update_password'])->name('profilepassword.update');

Route::get('/users', [ProfileController::class, 'index'])->name('users');
Route::get('/user_add', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/user_store', [ProfileController::class, 'store'])->name('profile.store');
Route::patch('/user/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/user_show/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::delete('/user_destroy/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');

//Department

Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
Route::get('/department_add', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/department_store', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/department_edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
Route::patch('/department/{id}/update', [DepartmentController::class, 'update'])->name('department.update');
Route::get('/department_show/{id}', [DepartmentController::class, 'show'])->name('department.show');
Route::delete('/department_destroy/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');

// Route::post('/tasks/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
Route::get('/', function () { return view('welcome');})->name('home');
Route::get('/about', function () { return view('about');});
Route::get('/contact', function () { return view('about');});

Route::get('/dashboard', function () { return view('about');});
Route::get('/contact', function () { return view('about');});
Route::get('/contact', function () { return view('about');});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login_page', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/registration', [RegistrationController::class, 'showregistrationForm'])->name('registration');
// Route::get('/login_page_employee', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login_welcome', [LoginController::class, 'login'])->name('login_welcome');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');



//reports
Route::get('/alltasks', [ReportController::class, 'alltasks'])->name('alltasks');
Route::get('/overdue_tasks', [ReportController::class, 'overdue_tasks'])->name('overdue_tasks');
Route::get('/completed_tasks', [ReportController::class, 'completed_tasks'])->name('completed_tasks');
Route::get('/emptask_summary', [ReportController::class, 'emptask_summary'])->name('emptask_summary');
Route::get('/pending_tasks', [ReportController::class, 'pending_tasks'])->name('pending_tasks');
Route::get('/estimated', [ReportController::class, 'estimated'])->name('estimated');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

require __DIR__.'/auth.php';
