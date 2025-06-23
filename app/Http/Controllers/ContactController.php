<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submitcontact(Request $request)
    {
        // Xử lý dữ liệu gửi từ form (ví dụ: gửi email, lưu DB, v.v.)
        // Ở đây mình chỉ trả về thông báo thành công

        return back()->with('success', 'Cảm ơn bạn đã liên hệ! 💌');
    }
}
