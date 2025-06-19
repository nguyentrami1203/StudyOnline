@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 bg-white shadow-lg rounded-lg">
    <div class="mb-4">
        <div class="w-full bg-gray-200 h-2 rounded overflow-hidden">
            <div id="progress-bar" class="bg-green-500 h-full transition-all duration-500" style="width: 100%"></div>
        </div>
        <div class="flex justify-between items-center mt-2">
            <h1 class="text-2xl font-bold text-gray-800">{{ $exam->title }}</h1>
            <div class="text-red-600 font-semibold text-lg">
                ⏰ Còn lại: <span id="countdown">--:--</span>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-2">
            Đã trả lời: <span id="answered-count">0</span> / {{ count($exam->questions) }}
        </p>
    </div>

    <form id="exam-form" method="POST" action="{{ route('exams.submit', $exam->id) }}">
        @csrf
        <input type="hidden" id="end-time" value="{{ $endTimestamp }}">
        <input type="hidden" id="duration" value="{{ $duration }}">

        @foreach($exam->questions as $index => $question)
        <div class="mb-6 border-b pb-4" id="question-{{ $question->id }}">
            <h2 class="font-semibold text-gray-700 mb-2">
                Câu {{ $index + 1 }}: {{ $question->content }}
            </h2>

            <div class="space-y-2">
                @foreach(['A', 'B', 'C', 'D'] as $option)
                <label class="flex items-center space-x-2 text-gray-600">
                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" class="accent-blue-500">
                    <span>{{ $question['option_' . strtolower($option)] }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="text-right mt-8">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Nộp bài
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const endTime = parseInt(document.getElementById('end-time').value) * 1000;
    const duration = parseInt(document.getElementById('duration').value) * 1000;
    const progressBar = document.getElementById('progress-bar');
    const countdownDisplay = document.getElementById('countdown');
    const answeredCount = document.getElementById('answered-count');
    const form = document.getElementById('exam-form');

    function updateCountdown() {
        const now = Date.now();
        const remaining = endTime - now;
        const percentLeft = Math.max((remaining / duration) * 100, 0);

        progressBar.style.width = percentLeft + '%';
        progressBar.classList.remove('bg-green-500', 'bg-yellow-500', 'bg-red-500');
        if (percentLeft < 20) {
            progressBar.classList.add('bg-red-500');
        } else if (percentLeft < 50) {
            progressBar.classList.add('bg-yellow-500');
        } else {
            progressBar.classList.add('bg-green-500');
        }

        if (remaining <= 0) {
            countdownDisplay.innerText = '00:00';
            alert("⏰ Hết giờ! Hệ thống sẽ tự động nộp bài.");
            form.submit();
        } else {
            const minutes = Math.floor(remaining / (1000 * 60));
            const seconds = Math.floor((remaining % (1000 * 60)) / 1000);
            countdownDisplay.innerText = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            if (remaining < 5 * 60 * 1000 && !window.warned) {
                alert("⚠️ Bạn chỉ còn chưa đầy 5 phút!");
                window.warned = true;
            }
        }
    }

    function updateAnsweredCount() {
        const count = document.querySelectorAll('input[type="radio"]:checked').length;
        answeredCount.innerText = count;
    }

    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', updateAnsweredCount);
    });

    updateAnsweredCount();
    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>
@endsection

