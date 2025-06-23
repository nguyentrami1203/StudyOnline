@extends('layout')
@section('title', 'Liên hệ')

@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ với chúng tôi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e6f0fa;
            margin: 0;
            padding: 0;
        }

        .contact-form {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 30px 40px;
            color: #333;
        }

        .contact-form h1 {
            text-align: center;
            color: #4096e6;
            margin-bottom: 20px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #cfe5fc;
            border-radius: 12px;
            background-color: #f4faff;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #4096e6;
            outline: none;
        }

        .contact-form button {
            background-color: #6fb8ff;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .contact-form button:hover {
            background-color: #4096e6;
        }

        .note {
            text-align: center;
            font-size: 0.95rem;
            color: #888;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="contact-form">
        <h1>📬 Liên hệ với chúng tôi</h1>
        <form action="{{ route('contact') }}" method="POST">
            @csrf
            <label for="name">Tên của bạn</label>
            <input type="text" id="name" name="name" placeholder="Nhập tên của bạn..." required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="example@email.com" required>

            <label for="message">Lời nhắn</label>
            <textarea id="message" name="message" rows="5" placeholder="Bạn muốn nói gì đó..." required></textarea>

            <button type="submit">Gửi tin nhắn</button>
        </form>
        <p class="note">Chúng tôi sẽ phản hồi trong thời gian sớm nhất 💙</p>
    </div>
</body>
</html>
@endsection