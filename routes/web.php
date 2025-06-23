<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ContactController;
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

Route::get('/exams/detail/{exam}', [ExamController::class, 'showDetailExam'])->name('exams.showDetailExam');

// Giao diện làm bài thi
Route::get('/exams/{exam}/take', [ExamController::class, 'take'])->name('exams.take');

// Nộp bài thi
Route::post('/exams/{exam}/submit', [ExamController::class, 'submit'])->name('exams.submit');

// Lịch sử làm bài 
Route::get('/exam/history', [ExamController::class, 'history'])->name('exam.history');

Route::get('/exam/result/{id}', [ExamController::class, 'viewResult'])->name('exam.result.detail');

Route::get('/exams/{exam}/retake', [ExamController::class, 'retake'])->name('exams.retake');

Route::get('/exam/list', [ExamController::class, 'list'])->name('exam.list');

Route::get('/tao-de', [ExamController::class, 'create'])->name('exams.create');
Route::post('/luu-de', [ExamController::class, 'store'])->name('exam.store');

Route::get('/quan-ly/de-thi-cua-toi', [ExamController::class, 'myExams'])->name('exams.my')->middleware('auth');

Route::get('/exams/{id}/edit-questions', [ExamController::class, 'editQuestions'])->name('exams.edit');
Route::put('exams/{exam}/update-questions', [ExamController::class, 'updateQuestions'])->name('exams.update_questions');
Route::delete('/exams/{examId}/questions/{questionId}', [ExamController::class, 'deleteQuestion'])->name('questions.detach');
Route::delete('/exams/{id}', [ExamController::class, 'destroy'])->name('exams.destroy');
Route::get('/bang-gia', [PriceController::class, 'price'])->name('price');
Route::get('/tính_năng', function () {return view('tính_năng');});
Route::get('/lien-he', function () {
    return view('contact'); // resources/views/contact.blade.php
})->name('contact');
Route::post('/lien-he', [ContactController::class, 'submitcontact'])->name('contact');
// Route auth mặc định
require __DIR__.'/auth.php';
