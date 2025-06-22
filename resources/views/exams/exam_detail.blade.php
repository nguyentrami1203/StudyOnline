@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold mb-4 text-indigo-700">📄 Chi tiết Đề thi số {{ $exam->id }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <p class="mb-2"><strong>Môn học:</strong> {{ $exam->subject->subject_name }}</p>
        <p class="mb-2"><strong>Cấp độ:</strong> {{ ucfirst($exam->level) }}</p>
        <p class="mb-2"><strong>Thời gian:</strong> {{ $exam->duration_minutes }} phút</p>
        <p class="mb-4"><strong>Số lượng câu hỏi:</strong> {{ $exam->questions->count() }}</p>

        <a href="{{ route('exams.take', $exam->id) }}"
           class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition text-sm">
            📝 Bắt đầu làm bài
        </a>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">📌 Danh sách câu hỏi</h2>

        @foreach($exam->questions as $index => $question)
            <div class="mb-6 p-4 border border-gray-200 rounded-lg bg-white shadow-sm">
                <p class="font-medium text-gray-800 mb-2">
                    Câu {{ $index + 1 }}: {{ $question->content }}
                </p>
                <ul class="list-disc pl-6 text-gray-700">
                    <li>A. {{ $question->option_a }}</li>
                    <li>B. {{ $question->option_b }}</li>
                    <li>C. {{ $question->option_c }}</li>
                    <li>D. {{ $question->option_d }}</li>
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection
