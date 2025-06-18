@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <a href="{{ route('exam.take', $result->exam->id) }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition mb-4">
        🔁 Làm lại đề thi
    </a>

    <h1 class="text-2xl font-bold mb-4">Kết quả bài thi: {{ $result->exam->title ?? $result->exam->exam_code }}</h1>
    <p class="mb-2">Điểm: {{ $result->score }} / {{ $total }}</p>

    @foreach($result->answers as $index => $answer)
        @php
            $question = $answer->question;
            $isCorrect = $answer->selected_answer === $question->correct_answer;
        @endphp

        <div class="mb-6 p-4 rounded-lg {{ $isCorrect ? 'bg-green-100' : 'bg-red-100' }}">
            <p class="font-semibold">Câu {{ $index + 1 }}: {{ $question->content }}</p>

            <ul class="mt-2">
                @foreach(['A', 'B', 'C', 'D'] as $opt)
                <li class="ml-4">
                    <strong>{{ $opt }}.</strong> {{ $question['option_' . strtolower($opt)] }}
                    @if($question->correct_answer === $opt)
                        <span class="text-green-600 font-semibold"> (Đáp án đúng)</span>
                    @endif
                    @if($answer->selected_answer === $opt && $opt !== $question->correct_answer)
                        <span class="text-red-600 font-semibold"> (Bạn chọn)</span>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
