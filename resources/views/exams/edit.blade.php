@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold mb-6">Chỉnh sửa đề thi: {{ $exam->exam_code }}</h2>

    {{-- FORM CẬP NHẬT --}}
    <form action="{{ route('exams.update_questions', $exam->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium text-gray-700 mb-1">Mã đề</label>
            <input type="text" name="exam_code" class="w-full border border-gray-300 rounded-lg px-4 py-2" value="{{ $exam->exam_code }}" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-1">Cấp độ</label>
            <input type="text" name="level" class="w-full border border-gray-300 rounded-lg px-4 py-2" value="{{ $exam->level }}" required>
        </div>

        <div>
            <label class="block font-medium text-gray-700 mb-1">Thời gian làm bài (phút)</label>
            <input type="number" name="duration_minutes" class="w-full border border-gray-300 rounded-lg px-4 py-2" value="{{ $exam->duration_minutes }}" required>
        </div>

        <hr class="my-6 border-gray-300">

        <h4 class="text-xl font-semibold mb-4">Câu hỏi hiện có</h4>

        @foreach($exam->questions as $question)
            <div class="bg-white p-6 rounded-lg shadow mb-6 relative">
                <strong class="block text-lg mb-4">Câu {{ $loop->iteration }}</strong>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-1">Nội dung</label>
                    <textarea name="existing_questions[{{ $question->id }}][content]" class="w-full border rounded px-4 py-2" required>{{ $question->content }}</textarea>
                </div>

                @foreach(['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'] as $key => $label)
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Đáp án {{ $label }}</label>
                        <input type="text" name="existing_questions[{{ $question->id }}][{{ $key }}]" class="w-full border rounded px-4 py-2" value="{{ $question->{'option_'.$key} }}" required>
                    </div>
                @endforeach

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-1">Đáp án đúng</label>
                    <select name="existing_questions[{{ $question->id }}][correct]" class="w-full border rounded px-4 py-2" required>
                        @foreach(['A', 'B', 'C', 'D'] as $opt)
                            <option value="{{ $opt }}" {{ $question->correct_answer === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach

        <div id="new-questions-container"></div>

        <button type="button" onclick="addNewQuestion()" class="mb-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded">
            + Thêm câu hỏi
        </button>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded">
            Lưu thay đổi
        </button>
    </form>

    {{-- FORM XOÁ CÂU HỎI --}}
    <hr class="my-8 border-gray-300">
    <h4 class="text-xl font-semibold mb-4">Xoá câu hỏi</h4>

    @foreach($exam->questions as $question)
        <form action="{{ route('questions.detach', [$exam->id, $question->id]) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xoá câu hỏi này?')" class="inline-block mb-2">
            @csrf
            @method('DELETE')
            <button class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded">
                Xoá câu {{ $loop->iteration }}
            </button>
        </form>
    @endforeach
</div>

<script>
    let newQuestionIndex = 0;

    function addNewQuestion() {
        const container = document.getElementById('new-questions-container');
        const html = `
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <strong class="block text-lg mb-4">Câu hỏi mới</strong>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-1">Nội dung</label>
                    <textarea name="new_questions[${newQuestionIndex}][content]" class="w-full border rounded px-4 py-2" required></textarea>
                </div>

                ${['a','b','c','d'].map(opt => `
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-1">Đáp án ${opt.toUpperCase()}</label>
                        <input type="text" name="new_questions[${newQuestionIndex}][${opt}]" class="w-full border rounded px-4 py-2" required>
                    </div>
                `).join('')}

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-1">Đáp án đúng</label>
                    <select name="new_questions[${newQuestionIndex}][correct]" class="w-full border rounded px-4 py-2" required>
                        <option value="">-- Chọn --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        newQuestionIndex++;
    }
</script>
@endsection
