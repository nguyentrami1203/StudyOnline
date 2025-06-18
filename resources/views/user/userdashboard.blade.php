@extends('user.layout2')
<link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">

@section('title', 'Trang người dùng')

@section('custom_css')
@endsection

@section('content')
<div class="main-container" style="display: flex;">
    {{-- SIDEBAR BÊN TRÁI --}}
    <div class="sidebar">
        <div class="menu-group">
            <div class="menu-title">👤 Cá nhân</div>
            <ul>
                <li><a href="#"><i class="icon">🧭</i> Khám phá đề thi</a></li>
                <li><a href="#"><i class="icon">🏠</i> Thư viện của tôi</a></li>
                <li><a href="#"><i class="icon">⏱</i> Truy cập gần đây</a></li>
                <li><a href="{{ route('exam.history') }}"><i class="icon">📝</i> Kết quả thi của tôi</a></li>
                <li><a href="#"><i class="icon">🏅</i> BXH thi đua <span style="color: orange;">🔥</span></a></li>
            </ul>
        </div>

        <div class="menu-group">
            <div class="menu-title">🎓 Quản lý</div>
            <ul>
                <li><a href="#"><i class="icon">📄</i> Đề thi</a></li>
                <li><a href="#"><i class="icon">🏫</i> Lớp học tập</a></li>  
                <li><form action="{{ route('logout') }}" method="POST" style="display: inline;">
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
            <div class="exam-grid">
                @foreach($exams as $exam)
                    <div class="exam-card">
                        <img src="{{ asset('Images/artthi.png') }}" alt="exam image">
                        <div class="exam-info">
                            <h4>Thi thử trắc nghiệm ôn tập môn {{ $exam->subject->subject_name }} - Đề #{{ $exam->id }}</h4>
                            <p>Đề số :{{ $exam->id }}| Môn :{{ $exam->subject->subject_name }} | Thời gian: {{ $exam->duration_minutes }} phút</p>
                            <a href="{{ route('exams.take', $exam->id) }}" class="btn btn-primary">Làm bài</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</div>
@endsection
