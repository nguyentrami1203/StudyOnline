<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user(); // Lấy thông tin người dùng hiện tại

        return view('user.usedashboard', compact('user'));
        // Đường dẫn view: resources/views/user/usedashboard.blade.php
    }
}
