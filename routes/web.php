<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\LeadController;
use App\Http\Controllers\TaskController;

Route::middleware('auth')->group(function () {
    Route::resource('leads', LeadController::class);
    Route::post('leads/{lead}/tasks', [TaskController::class, 'store'])->name('leads.tasks.store');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
