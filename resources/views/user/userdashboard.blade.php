@extends('layouts.app')

@section('title', 'Trang người dùng')

{{-- CSS riêng --}}
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/userdashboard.css') }}">
@endsection

@section('content')
    <div class="dashboard-container">
        <h2>Xin chào, {{ Auth::user()->name }}</h2>
        <p>Chào mừng bạn đến với trang cá nhân.</p>

        <div class="exam-list">
            @foreach($exams as $exam)
                <div class="exam-card">
                    <img src="{{ asset('images/exam.png') }}" alt="exam image">
                    <div class="exam-info">
                        <h3>{{ $exam->title }}</h3>
                        <p>{{ $exam->description }}</p>
                        <a href="{{ route('exams.start', $exam->id) }}" class="btn btn-primary">Làm bài</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
