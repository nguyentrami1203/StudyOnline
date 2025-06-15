@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">✅ Kết quả</h2>
    <p>Bạn trả lời đúng {{ $score }} trên {{ count($questions) }} câu hỏi.</p>
    <p class="text-gray-600 mt-2">
        Tỷ lệ chính xác: <span class="font-semibold text-indigo-600">{{ $percentage }}%</span>
    </p>
</div>
@endsection
