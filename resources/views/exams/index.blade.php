@foreach ($exams as $exam)
<div class="exam-card">
    <img src="{{ asset('images/exam.jpg') }}" alt="exam image">
    <div class="exam-info">
        <h3>Thi thử trắc nghiệm ôn tập môn {{ $exam->subject->subject_name }} - Đề #{{ $exam->id }}</h3>
        <p>Đề số {{ $exam->id }} thuộc môn {{ $exam->subject->subject_name }} với thời gian làm bài {{ $exam->duration_minutes }} phút.</p>
        <a href="{{ route('exams.show', $exam->id) }}" class="btn">Làm bài</a>
    </div>
</div>
<style>
    .exam-card {
    display: flex;
    background: #f3f3f3;
    border-radius: 12px;
    margin-bottom: 20px;
    padding: 15px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}

.exam-card img {
    width: 140px;
    border-radius: 10px;
    margin-right: 15px;
}

.exam-info h3 {
    font-size: 18px;
    font-weight: bold;
    color: #222;
}

.exam-info p {
    color: #555;
    margin: 10px 0;
}

.exam-info .btn {
    display: inline-block;
    padding: 6px 12px;
    background-color: green;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
}

</style>
@endforeach
