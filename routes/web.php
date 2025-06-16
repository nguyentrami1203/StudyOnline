<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;

Route::get('/', [ExamController::class, 'index'])->name('home');

// Trang dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Các route liên quan đến profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Điều hướng theo role
Route::get('/redirect-by-role', function () {
    /** @var User $user */
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified']);

// Trang dashboard cho admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.dashboard');

// Trang dashboard cho user
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

// Hiển thị chi tiết 1 đề thi (dùng để xử lý nút "Làm bài")
Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');

// Giao diện làm bài thi
Route::get('/exams/{exam}/take', [ExamController::class, 'take'])->name('exams.take');

// Nộp bài thi
Route::post('/exams/{exam}/submit', [ExamController::class, 'submit'])->name('exams.submit');

// Lịch sử làm bài (nếu bạn có)
Route::get('/exam/history', [ExamController::class, 'history'])->name('exam.history');

require __DIR__.'/auth.php';
