@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold mb-6 text-center text-indigo-700">📚 Khám phá các đề thi</h1>

    <div class="mb-6 text-center">
        <form method="GET" action="{{ route('exam.list') }}" class="inline-block">
            <select name="subject" onchange="this.form.submit()"
                    class="border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:ring focus:border-indigo-500">
                <option value="">-- Tất cả môn học --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $subjectId == $subject->id ? 'selected' : '' }}>
                        {{ $subject->subject_name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    @if($exams->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($exams as $exam)
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 hover:shadow-md transition duration-300">
                    
                    <img src="{{ asset('Images/artthi.png') }}"
                        alt="Ảnh minh họa đề thi"
                        class="rounded-xl mb-4 w-full h-40 object-cover">

                    <div class="mb-3">
                        <span class="inline-block text-xs bg-indigo-100 text-indigo-600 px-2 py-1 rounded-md">
                            Môn học: {{ $exam->subject->subject_name }}
                        </span>
                    </div>

                    <h2 class="text-lg font-semibold text-gray-800 mb-1">Đề thi số {{ $exam->id }}</h2>
                    <p class="text-sm text-gray-600 mb-1">Cấp độ: 
                        <span class="capitalize font-medium">{{ $exam->level }}</span>
                    </p>
                    <p class="text-sm text-gray-600 mb-4">⏱️ Thời gian: {{ $exam->duration_minutes }} phút</p>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('exams.showDetailExam', $exam->id) }}"
                        class="text-blue-600 hover:underline text-sm font-medium">
                            🔍 Xem chi tiết
                        </a>

                        <a href="{{ route('exams.take', $exam->id) }}"
                        class="bg-green-600 text-white hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                            📝 Làm bài
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $exams->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-center text-gray-500">Không có đề thi nào được tìm thấy.</p>
    @endif
</div>
@endsection
