@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">📊 Bảng điều khiển quản trị viên</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-white">
        <div class="bg-blue-600 rounded-xl shadow p-4">
            <h5 class="text-lg font-semibold">Tổng người dùng</h5>
            <p class="text-2xl mt-2">{{ $totalUsers }}</p>
        </div>
        <div class="bg-green-600 rounded-xl shadow p-4">
            <h5 class="text-lg font-semibold">Người dùng đang online</h5>
            <p class="text-2xl mt-2">{{ $onlineUsers }}</p>
        </div>
        <div class="bg-yellow-500 rounded-xl shadow p-4">
            <h5 class="text-lg font-semibold">Người dùng trả phí</h5>
            <p class="text-2xl mt-2">{{ $paidUsers }}</p>
        </div>
    </div>

    <div class="bg-purple-600 rounded-xl shadow p-4 mt-4">
        <h5 class="text-lg font-semibold">Tổng số đề thi</h5>
        <p class="text-2xl mt-2">{{ $totalExams }}</p>
    </div>

    <h4 class="text-xl font-bold mt-10 mb-4">💰 Doanh thu theo quý</h4>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow text-sm">
            <thead class="bg-gray-100 text-gray-700 text-left">
                <tr>
                    <th class="p-3">Năm</th>
                    <th class="p-3">Quý</th>
                    <th class="p-3">Doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenueByQuarter as $row)
                <tr class="border-t">
                    <td class="p-3">{{ $row->year }}</td>
                    <td class="p-3">Q{{ $row->quarter }}</td>
                    <td class="p-3">{{ number_format($row->total, 0, ',', '.') }} đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h4 class="text-xl font-bold mt-10 mb-4">📈 Biểu đồ doanh thu</h4>

    @if($revenueByQuarter->isEmpty())
        <p class="text-red-600 font-semibold mt-4">
            ⚠️ Chưa có dữ liệu doanh thu để hiển thị biểu đồ.
        </p>
    @else
        <canvas id="revenueChart" width="400" height="200" class="w-full max-w-2xl mx-auto"></canvas>

        <div id="chart-labels" class="hidden">
            {!! json_encode($revenueByQuarter->map(fn($r) => 'Q'.$r->quarter.'-'.$r->year)) !!}
        </div>
        <div id="chart-data" class="hidden">
            {!! json_encode($revenueByQuarter->pluck('total')) !!}
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/admin-dashboard.js') }}"></script>
@endsection
