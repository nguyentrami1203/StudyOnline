<?php

namespace App\Http\Controllers;

use App\Models\Exam; // THÊM DÒNG NÀY để gọi model Exam

class UserController extends Controller
{
    public function dashboard()
    {
        $exams = Exam::all(); // Lấy tất cả đề thi
        return view('user.userdashboard', compact('exams'));
    }

}
