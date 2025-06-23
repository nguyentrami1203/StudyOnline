@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f8;
        margin: 0;
    }

    .main-container {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 240px;
        background-color: #1e293b;
        color: #fff;
        padding: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar .menu-group {
        margin-bottom: 30px;
    }

    .menu-title {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 14px;
        color: #a0aec0;
        text-transform: uppercase;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar ul li {
        margin-bottom: 10px;
    }

    .sidebar ul li a {
        color: #f8fafc;
        text-decoration: none;
        padding: 8px 12px;
        display: block;
        border-radius: 6px;
        transition: 0.3s;
    }

    .sidebar ul li a:hover {
        background-color: #334155;
    }

    .content {
        flex: 1;
        padding: 40px;
    }

    .content h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 30px;
        color: #1e293b;
    }

    .exam-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        width: 300px;
        transition: transform 0.2s;
    }

    .exam-card:hover {
        transform: translateY(-5px);
    }

    .exam-card img {
        width: 100%;
        border-radius: 8px;
    }

    .exam-card h4 {
        font-size: 18px;
        margin-top: 15px;
        margin-bottom: 10px;
        color: #0f172a;
    }

    .exam-card p {
        font-size: 14px;
        color: #475569;
        margin: 2px 0;
    }

    .exam-actions {
        margin-top: 15px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 6px 12px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        color: #fff;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-primary {
        background-color: #3b82f6;
    }

    .btn-primary:hover {
        background-color: #2563eb;
    }

    .btn-warning {
        background-color: #f59e0b;
    }

    .btn-warning:hover {
        background-color: #d97706;
    }

    .btn-danger {
        background-color: #ef4444;
    }

    .btn-danger:hover {
        background-color: #dc2626;
    }
</style>
{{-- NỘI DUNG CHÍNH --}}
    <div class="content">
        <h2>📝 Danh sách đề thi bạn đã tạo</h2>

        @if ($exams->isEmpty())
            <p>Bạn chưa tạo đề thi nào.</p>
        @else
            <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                @foreach ($exams as $exam)
                    <div class="exam-card">
                        <img src="{{ asset('images/artthi.png') }}" alt="Exam Thumbnail">
                        <h4>{{ $exam->exam_code }}</h4>
                        <p><strong>Môn:</strong> {{ $exam->subject->subject_name ?? 'Không rõ' }}</p>
                        <p><strong>Độ khó:</strong> {{ $exam->level }}</p>
                        <p><strong>Thời gian:</strong> {{ $exam->duration_minutes }} phút</p>

                        <div class="exam-actions">
                            <a href="{{ route('exams.showDetailExam', $exam->id) }}" class="btn btn-primary">Xem đề</a>
                            <a href="{{ route('exams.edit', $exam->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('exams.destroy', $exam->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa đề này?')">Xóa</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
