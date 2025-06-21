@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <a href="{{ route('exams.retake', $result->exam->id) }}"
        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition mb-4">
        🔁 Làm lại đề thi
    </a>

    <h1 class="text-2xl font-bold mb-4">
        Kết quả bài thi: {{ $result->exam->subject->subject_name }} - Đề #{{ $result->exam->id }} {{ $result->exam->level }}
    </h1>
    <p class="mb-2">Điểm: {{ $result->score }} / {{ $total }}</p>

    @foreach($result->answers as $index => $answer)
        @php
            $question = $answer->question;
            $isUserCorrect = $answer->selected_answer === $question->correct_answer;
        @endphp

        <div class="mb-6 p-4 rounded-lg {{ $isUserCorrect ? 'bg-green-100' : 'bg-red-100' }}">
            <p class="font-semibold">Câu {{ $index + 1 }}: {{ $question->content }}</p>
            @if (empty($answer->selected_answer))
                <p class="text-sm text-red-500 italic mt-1">Bạn chưa chọn câu trả lời cho câu hỏi này.</p>
            @endif
            <ul class="mt-2 space-y-1">
                @foreach(['A', 'B', 'C', 'D'] as $opt)
                    @php
                        $optionText = $question['option_' . strtolower($opt)];
                        $isOptionCorrect = $question->correct_answer === $opt;
                        $isSelected = $answer->selected_answer === $opt;
                        $class = '';

                        if ($isOptionCorrect && $isSelected) {
                            $class = 'bg-green-200 text-green-900 font-semibold';
                        } elseif ($isOptionCorrect) {
                            $class = 'bg-green-100 text-green-800';
                        } elseif ($isSelected) {
                            $class = 'bg-red-200 text-red-900 font-semibold';
                        }
                    @endphp
                    <li class="ml-4 px-2 py-1 rounded {{ $class }}">
                        <strong>{{ $opt }}.</strong> {{ $optionText }}
                        @if ($isOptionCorrect)
                            <span class="ml-1">✅ (Đáp án đúng)</span>
                        @endif
                        @if ($isSelected && !$isOptionCorrect)
                            <span class="ml-1">❌ (Bạn chọn)</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
