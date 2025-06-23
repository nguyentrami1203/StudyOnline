@extends('layout')

@section('title', 'Tính năng hệ thống')

@section('content')
<style>
    .feature-section {
        padding: 50px 20px;
        background: #f9f9f9;
        font-family: 'Segoe UI', sans-serif;
        text-decoration: none;
    }

    .feature-title {
        text-align: center;
        font-size: 36px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 40px;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: auto;
    }

    .feature-card {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        font-size: 50px;
        color: #3498db;
        margin-bottom: 20px;
    }

    .feature-name {
        font-size: 20px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .feature-desc {
        font-size: 15px;
        color: #666;
        line-height: 1.6;
    }
</style>

<div class="feature-section">
    <div class="feature-title">Tính năng nổi bật</div>
    <div class="feature-grid">
        <div class="feature-card"><a href="{{ route('login') }}" style="text-decoration: none;">
            <div class="feature-icon">📚</div>
            <div class="feature-name">Thư viện đề thi</div>
            <div class="feature-desc">Cung cấp hàng ngàn đề thi trắc nghiệm từ nhiều môn học khác nhau.</div>
            </a>
        </div>
        <div class="feature-card"><a href="{{ route('login') }}" style="text-decoration: none;">
            <div class="feature-icon">📝</div>
            <div class="feature-name">Thi trực tuyến</div>
            <div class="feature-desc">Cho phép người dùng làm bài thi ngay trên nền tảng và chấm điểm tự động.</div>
            </a>
        </div>
        <div class="feature-card"><a href="{{ route('login') }}" style="text-decoration: none;">
            <div class="feature-icon">📈</div>
            <div class="feature-name">Phân tích kết quả</div>
            <div class="feature-desc">Xem thống kê chi tiết điểm số và tiến độ học tập của bạn.</div>
            </a>
        </div>
        <div class="feature-card"><a href="{{ route('login') }}" style="text-decoration: none;">
            <div class="feature-icon">🔒</div>
            <div class="feature-name">Bảo mật cao</div>
            <div class="feature-desc">Hệ thống bảo mật tài khoản và dữ liệu cá nhân của bạn an toàn tuyệt đối.</div>
            </a>
        </div>
        <div class="feature-card"><a href="{{ route('login') }}" style="text-decoration: none;">
            <div class="feature-icon">📅</div>
            <div class="feature-name">Lịch sử thi</div>
            <div class="feature-desc">Xem lại tất cả các bài thi đã thực hiện, điểm số và ngày thi.</div>
            </a>
        </div>
        <div class="feature-card"><a href="{{ route('login') }}" style="text-decoration: none;">
            <div class="feature-icon">💬</div>
            <div class="feature-name">Hỗ trợ 24/7</div>
            <div class="feature-desc">Đội ngũ hỗ trợ luôn sẵn sàng giải đáp mọi thắc mắc của bạn.</div>
            </a>
        </div>
    </div>
</div>
@endsection