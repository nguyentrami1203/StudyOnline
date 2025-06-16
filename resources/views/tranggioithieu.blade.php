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

@foreach ($exams as $exam)
    <div class="exam-card">
        <img src="{{ asset('Images/artthi.png') }}" alt="exam image">
        <div class="exam-info">
            <h3>Thi thử trắc nghiệm ôn tập môn {{ $exam->subject->subject_name }} - Đề #{{ $exam->id }}</h3>
            <p>Đề số {{ $exam->id }} thuộc môn {{ $exam->subject->subject_name }} với thời gian làm bài {{ $exam->duration_minutes }} phút.</p>
            <a href="{{ route('exams.show', $exam->id) }}" class="btn">Làm bài</a>
        </div>
    </div>
@endforeach
@endsection
