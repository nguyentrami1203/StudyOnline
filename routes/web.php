<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth; 
use App\Models\User; 
use App\Http\Controllers\ExamController;

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

Route::get('/redirect-by-role', function () {
    /** @var User $user */
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified']);

Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])
->name('user.dashboard');

Route::get('/exams/{exam}/take', [ExamController::class, 'take'])->name('exams.take');
Route::post('/exams/{exam}/submit', [ExamController::class, 'submit'])->name('exams.submit');
Route::get('/exam/history', [App\Http\Controllers\ExamController::class, 'history'])->name('exam.history');

require __DIR__.'/auth.php';
