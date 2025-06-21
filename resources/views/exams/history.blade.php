@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Lịch sử làm bài</h1>

    @if($results->isEmpty())
        <p class="text-gray-600">Bạn chưa làm bài kiểm tra nào.</p>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead class="bg-gray-100 text-gray-700 text-left">
                <tr>
                    <th class="py-3 px-4">Tên bài</th>
                    <th class="py-3 px-4">Loại đề thi</th>
                    <th class="py-3 px-4">Điểm</th>
                    <th class="py-3 px-4">Tỷ lệ (%)</th>
                    <th class="py-3 px-4">Thời gian</th>
                    <th class="py-3 px-4">Chi tiết</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($results as $result)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $result->exam->subject->subject_name }} - Đề #{{ $result->exam->id }} </td>
                    <td class="py-2 px-4">{{ $result->exam->level }}</td>
                    <td class="py-2 px-4">{{ $result->score }} / {{ $result->total }}</td>
                    @php
                        $color = $result->percentage >= 80 ? 'text-green-600' : ($result->percentage >= 50 ? 'text-yellow-600' : 'text-red-600');
                    @endphp
                    <td class="py-2 px-4 {{ $color }}">{{ $result->percentage }}%</td>
                    <td class="py-2 px-4">{{ $result->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('exam.result.detail', $result->id) }}" class="text-blue-600 hover:underline">
                            Xem chi tiết
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
