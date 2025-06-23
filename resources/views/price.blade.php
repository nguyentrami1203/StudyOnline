@extends('layout')
@section('title', 'Bảng giá')

@section('content')
<style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #4f46e5;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background:rgb(104, 210, 246);
            color: white;
        }

        th, td {
            padding: 16px;
            border-bottom: 1px solid #ddd;
        }

        td {
            color: #333;
        }

        tr:nth-child(even) {
            background: #f9fafb;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                background:rgb(97, 199, 243);
                color: white;
            }

            td {
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
                color:rgb(48, 202, 249);
            }
        }
    </style>
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">Bảng giá</h1>

    <table class="w-full border border-gray-300">
        <thead class="bg-indigo-600 text-white">
            <tr>
                <th class="p-3">Gói</th>
                <th class="p-3 text-center">Thời hạn</th>
                <th class="p-3 text-right">Giá</th>
            </tr>
        </thead>
        <tbody class="bg-gray-100 text-gray-800">
            <tr>
                <td class="p-3">Cơ bản</td>
                <td class="p-3 text-center">1 tháng</td>
                <td class="p-3 text-right">99.000đ</td>
            </tr>
            <tr class="bg-white">
                <td class="p-3">Nâng cao</td>
                <td class="p-3 text-center">3 tháng</td>
                <td class="p-3 text-right">249.000đ</td>
            </tr>
            <tr>
                <td class="p-3">Chuyên nghiệp</td>
                <td class="p-3 text-center">12 tháng</td>
                <td class="p-3 text-right">799.000đ</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection