@extends('layout')
<link rel="stylesheet" href="{{ asset('css/tranggioithieu.css') }}">

@section('content')
<div class="K1">
    <p>Tạo đề đơn giản, học tập dễ dàng</p>
    <p id="typingText">Welcome to StudyOnline</p>
    <p>trắc nghiệm online</p>
</div>

<script>
    const text = "Welcome to StudyOnline";
    let i = 0;
    let isDeleting = false;
    const speed = 100;
    const eraseSpeed = 50;
    const waitTime = 1000;
    const element = document.getElementById("typingText");

    function typeEffect() {
        if (!isDeleting && i <= text.length) {
            element.innerHTML = text.substring(0, i);
            i++;
            setTimeout(typeEffect, speed);
        } else if (isDeleting && i >= 0) {
            element.innerHTML = text.substring(0, i);
            i--;
            setTimeout(typeEffect, eraseSpeed);
        } else {
            isDeleting = !isDeleting;
            setTimeout(typeEffect, waitTime);
        }
    }

    typeEffect();
</script>

@foreach($examsByLevel as $level => $subjects)
    <h2>{{ $level }}</h2>
    @foreach($subjects as $subject)
        <h4>{{ $subject['subject_name'] }}</h4>
        <div class="exam-list">
            @foreach($subject['exams'] as $index => $exam)
                <div class="exam-card">
                    <img src="{{ asset('Images/artthi.png') }}" alt="Exam image">
                    <div class="exam-info">
                        <h5>Thi thử trắc nghiệm ôn tập môn {{ $subject['subject_name'] }} - Đề #{{ $exam->id }}</h5>
                        <p>Đề số {{ $exam->id }} với thời gian làm bài {{ $exam->duration_minutes }} phút.</p>
                        <a href="{{ route('login') }}" class="btn">Làm bài</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endforeach
@endsection
