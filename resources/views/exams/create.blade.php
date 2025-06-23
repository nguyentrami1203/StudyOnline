@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tạo đề thi mới</h2>
    <form method="POST" action="{{ route('exam.store') }}">
        @csrf

        <div class="mb-3">
            <label>Mã môn học:</label>
            <input type="number" name="subject_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mã đề thi:</label>
            <input type="text" name="exam_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Độ khó:</label>
            <select name="level" class="form-control">
                <option value="Dễ">Dễ</option>
                <option value="Trung bình">Trung bình</option>
                <option value="Khó">Khó</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Thời gian làm (phút):</label>
            <input type="number" name="duration_minutes" class="form-control" required>
        </div>

        <div id="questions-container"></div>

        <button type="button" class="btn btn-secondary" onclick="addQuestion()">+ Thêm câu hỏi</button><br><br>
        <button type="submit" class="btn btn-primary">Lưu đề thi</button>
    </form>
</div>

<script>
    let questionCount = 0;

    function addQuestion() {
        const container = document.getElementById('questions-container');
        const html = `
        <div class="question-block mb-4 p-3 border rounded">
            <h5>Câu ${questionCount + 1}</h5>
            <textarea name="questions[${questionCount}][content]" class="form-control mb-2" placeholder="Nội dung câu hỏi" required></textarea>
            <input type="text" name="questions[${questionCount}][a]" class="form-control mb-1" placeholder="Đáp án A" required>
            <input type="text" name="questions[${questionCount}][b]" class="form-control mb-1" placeholder="Đáp án B" required>
            <input type="text" name="questions[${questionCount}][c]" class="form-control mb-1" placeholder="Đáp án C" required>
            <input type="text" name="questions[${questionCount}][d]" class="form-control mb-1" placeholder="Đáp án D" required>

            <label>Đáp án đúng:</label>
            <select name="questions[${questionCount}][correct]" class="form-control mb-2" required>
                <option value="">--Chọn--</option>
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        questionCount++;
    }

    window.onload = addQuestion;
</script>
@endsection