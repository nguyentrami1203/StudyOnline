<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>
<body>
    <header>
        <div class = "container1">
           <img src="Images\test.png" alt="Logo">
           <div class = "menu">
            <nav>
                <ul>
                    <li><a href="">Tính năng</a></li>
                    <li><a href="">Tạo đề</a></li>
                    <li><a href="">Bảng giá</a></li>
                    <li><a href="">Liên hệ</a></li>
                    <li><a href="http://localhost/StudyOnline/public/login" class="btn">Đăng nhập</a></li>
                </ul>
           </nav>
           </div>
        </div>
    </header>
    
    <main>
        @yield('content')
    </main>

    <footer>
        <div class = "container2">
            <div class = "Kh1">
                <img src="Images\test.png" alt="logo">
                <p>Nền tảng thi trắc nghiệm online</p>
                <hr class="purple-line">
                <p>Thanh toán</p>
                <div class ="logo">
                <img src="Images\zalo.png" alt="x">
                <img src="Images\vnpay.png" alt="x">
                <img src="Images\mono.png" alt="x">
                <img src="Images\napas.png" alt="x">
                </div>
            </div>

            <div class = "K2">
                <div class = "column">
                    <h4>Sản phẩm dịch vụ<br></h4>
                    <p>Ôn thi sinh viên</p>
                    <p>Tổ chức thi</p>
                    <p>Luyện thi THPT Quốc Gia</p>
                </div>

                <div class = "column">
                    <h4>Tài nguyên<br></h4>
                    <p>Tin tức</p>
                    <p>Kinh nghiệm ôn thi</p>
                    <p>Cẩm nang ôn thi THPTQG</p>
                    <p>Hoạt động cộng đồng</p>
                </div>

                <div class = "column">
                    <h4><br>Chính sách</h4>
                    <p>Điều khoản sử dụng</p>
                    <p>Điều khoản bảo mật</p>
                </div>
            </div>
        </div>

        <hr class="purple-line">

        <div class = "copyright">
           FinalProject © 2025 NM
        </div>
    </footer>

    
</body>
</html>