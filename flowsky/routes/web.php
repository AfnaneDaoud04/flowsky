<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MyTasksController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);

    Route::post('/projects/{project}/invitations', [InvitationController::class, 'store'])
        ->name('invitations.store');

    Route::resource('projects.tasks', TaskController::class)->shallow();

    Route::get('/my-tasks', [MyTasksController::class, 'index'])->name('my-tasks.index');
});

Route::get('/invitations/{token}', [InvitationController::class, 'accept'])
    ->name('invitations.accept');

require __DIR__.'/auth.php';