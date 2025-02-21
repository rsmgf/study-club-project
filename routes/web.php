<?php
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Jobs\SendTaskReminderEmail;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect('/dashboard') : redirect('/login');
});


Route::middleware(['auth'])->group(function () {
    // Account
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // To Do List
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/pending', [TaskController::class, 'pending'])->name('pending');
    Route::get('/completed', [TaskController::class, 'completed'])->name('completed');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::get('/deleted', [TaskController::class, 'deleted'])->name('deleted');
    Route::patch('/tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
    Route::patch('/tasks/{task}/restore-completed', [TaskController::class, 'restoreFromCompleted'])->name('tasks.restoreCompleted');
    Route::delete('/tasks/{task}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.forceDelete');

    
    Route::resource('tasks', TaskController::class)->except(['show']);

});

require __DIR__.'/auth.php';

