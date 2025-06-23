<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/layoutuse.css') }}">

 </head>
 <body>
    <header class="header">
        <div class="logo">
            <img src="{{ asset('Images/test.png') }}" alt="Logo" class="logo-img">
        </div>
        <div class="user-info">
            <a href="{{ route('exams.create') }}"><button class="btn-create">➕ Tạo đề thi</button></a>
            <img src="{{ asset('Images/avarta.jpg') }}" alt="Avatar" class="avatar">
        </div>
    </header>
    
    <main> 
        @yield('content')
    </main>
    <footer>
        <footer class="footer">
    <div class="support">
        🧑‍💻 Hỗ trợ tư vấn
    </div>
    <div class="copyright">
        © StudyOnline 2025 - {{ date('Y') }}
    </div>
</footer>
    </footer>
 </body>
 </html>

<!-- FOOTER -->