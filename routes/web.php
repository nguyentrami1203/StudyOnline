<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use Illuminate\Support\Facades\Auth;

// Trang chủ (danh sách đề thi)
Route::get('/', [ExamController::class, 'index'])->name('home');

// Tự động điều hướng dashboard theo role
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Giao diện làm bài thi (chỉ cho người đăng nhập)
Route::get('/exams/{exam}/take', [ExamController::class, 'take'])
    ->middleware('auth')
    ->name('exams.take');

// Nộp bài thi (cũng cần đăng nhập)
Route::post('/exams/{exam}/submit', [ExamController::class, 'submit'])
    ->middleware('auth')
    ->name('exams.submit');

// Trang dashboard cho admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.dashboard');

// Trang dashboard cho user
Route::get('/user/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('user.dashboard');

// Các route liên quan đến profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Hiển thị chi tiết 1 đề thi (dùng để xử lý nút "Làm bài")
Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');

// Giao diện làm bài thi
Route::get('/exams/{exam}/take', [ExamController::class, 'take'])->name('exams.take');

// Nộp bài thi
Route::post('/exams/{exam}/submit', [ExamController::class, 'submit'])->name('exams.submit');

// Lịch sử làm bài 
Route::get('/exam/history', [ExamController::class, 'history'])->name('exam.history');

Route::get('/exam/result/{id}', [ExamController::class, 'viewResult'])->name('exam.result.detail');

Route::get('/exams/{exam}/retake', [ExamController::class, 'retake'])->name('exams.retake');

// Route auth mặc định
require __DIR__.'/auth.php';
