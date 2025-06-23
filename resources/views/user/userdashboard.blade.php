@extends('user.layout2')
<link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">

@section('title', 'Trang người dùng')

@section('custom_css')
<style>
    @keyframes spin-slow {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .animate-spin-slow {
        animation: spin-slow 6s linear infinite;
    }
</style>
@endsection

@section('content')
<div class="main-container" style="display: flex;">
    {{-- SIDEBAR BÊN TRÁI --}}
    <div class="sidebar">
        <div class="menu-group">
            <div class="menu-title">👤 Cá nhân</div>
            <ul>
                <li><a href="{{ route('exam.list') }}"><i class="icon">🧭</i> Khám phá đề thi</a></li>
                <li><a href="{{ route('exam.history') }}"><i class="icon">📝</i> Kết quả thi của tôi</a></li>
            </ul>
        </div>

        <div class="menu-group">
            <div class="menu-title">🎓 Quản lý</div>
            <ul>
                <li><a href="{{ route('exams.my') }}"><i class="icon">📄</i> Đề thi</a></li>  
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color:black; cursor: pointer;">
                            <i class="icon">🚪</i> Đăng xuất
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    {{-- NỘI DUNG CHÍNH --}}
    <div class="dashboard-container" style="margin-left: 20px; flex: 1;">
        <h2>Xin chào, {{ Auth::user()->name }}</h2>
        <p>Chào mừng bạn đến với trang cá nhân.</p>

        <div class="exam-list">
            <div class="flex justify-center">
                <div class="max-w-4xl w-full px-4 flex flex-col items-center gap-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="flex flex-col items-center p-4 bg-indigo-50 rounded-xl shadow hover:scale-105 transition-transform duration-300">
                            <div class="text-6xl animate-pulse">🧠</div>
                            <p class="mt-3 text-sm text-indigo-700 font-medium">Luyện tập mỗi ngày giúp bạn tiến bộ</p>
                        </div>
                        <div class="flex flex-col items-center p-4 bg-pink-50 rounded-xl shadow hover:scale-105 transition-transform duration-300">
                            <div class="text-6xl animate-bounce">🔑</div>
                            <p class="mt-3 text-sm text-pink-700 font-medium">Kiên trì là chìa khóa thành công</p>
                        </div>
                        <div class="flex flex-col items-center p-4 bg-yellow-50 rounded-xl shadow hover:scale-105 transition-transform duration-300">
                            <div class="text-6xl animate-spin-slow">🎉</div>
                            <p class="mt-3 text-sm text-yellow-700 font-medium">Học mà chơi, chơi mà học</p>
                        </div>
                    </div>

                    <div class="text-center mt-6">
                        <h2 class="text-2xl md:text-3xl font-bold text-indigo-700 mb-3">📖 Học tập thật vui!</h2>
                        <p class="text-gray-600 text-base md:text-lg">
                            Đây là không gian học tập sáng tạo và thú vị. Hãy chuẩn bị tinh thần cho những thử thách mới nhé! ✨
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection