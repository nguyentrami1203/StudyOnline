<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Hiển thị giao diện đăng nhập.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập từ người dùng.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Xác thực tài khoản
        $request->authenticate();

        // Tạo lại session để bảo mật
        $request->session()->regenerate();

        // Lấy user sau khi đăng nhập
        $user = $request->user();

        // Chuyển hướng theo role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard'); // ví dụ: route đến trang quản trị
        } elseif ($user->role === 'user') {
            return redirect()->route('user.dashboard'); // ví dụ: route đến giao diện người dùng
        }

        // Nếu chưa có role rõ ràng → quay về trang chủ
        return redirect('/');
    }

    /**
     * Đăng xuất người dùng và xóa session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
