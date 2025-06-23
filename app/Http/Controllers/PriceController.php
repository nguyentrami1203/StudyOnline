<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function price()
    {
        // logic lấy dữ liệu bảng giá nếu có, hoặc trả view tĩnh
        return view('price');  // tạo file resources/views/price/index.blade.php
    }
}