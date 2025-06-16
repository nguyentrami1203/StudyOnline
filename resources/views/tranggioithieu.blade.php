@extends('layout')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/tranggioithieu.css') }}">
</head>
<body>
    @section('content')
    <div class = "K1">
        <p>Tạo đề đơn giản, học tập dễ dàng</p>
        <p id="typingText">Welcom to StudyOnline</p>
        <p>trắc nghiệm online</p>
        <hr class="purple-line">
        <p>Tạo câu hỏi và đề thi nhanh với những giải pháp thông minh.<br>EduQuiz tận dụng sức mạnh công nghệ để nâng cao trình độ học tập của bạn.</p>
    </div>
    <script>
    const text = "Welcome to StudyOnline";
    let i = 0;
    let isDeleting = false;
    const speed = 100; // tốc độ gõ
    const eraseSpeed = 50; // tốc độ xóa
    const waitTime = 1000; // thời gian dừng lại trước khi xóa
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
</body>
</html>
@endsection
