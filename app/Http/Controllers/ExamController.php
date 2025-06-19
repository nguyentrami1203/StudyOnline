<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use Carbon\Carbon;
use App\Models\ExamResult;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamAnswer;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Lấy tất cả môn học và đề thi liên quan
        $subjects = Subject::with('exams')->get();

        // Group lại theo cấp học
        $examsByLevel = $subjects->groupBy('level')->map(function ($subjects) {
            return $subjects->map(function ($subject) {
                return [
                    'subject_name' => $subject->subject_name,
                    'exams' => $subject->exams
                ];
            });
        });

        return view('tranggioithieu', compact('examsByLevel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showExam(Exam $exam)
    {
        if (!session()->has("exam_start_time_{$exam->id}")) {
            session(["exam_start_time_{$exam->id}" => now()]);
        }

        $startTime = Carbon::parse(session("exam_start_time_{$exam->id}"));
        $endTime = $startTime->copy()->addMinutes($exam->duration_minutes);

        return view('exam.take', compact('exam', 'startTime', 'endTime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function history()
    {
        $results = ExamResult::with('exam')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('exams.history', compact('results'));
    }

    public function viewResult($id)
    {
        $result = ExamResult::with(['exam', 'answers.question'])->findOrFail($id);

        // Tính tổng số câu
        $total = $result->exam->questions->count();

        return view('exams.result_detail', compact('result', 'total'));
    }

    public function take(Exam $exam)
    {
        // Nếu chưa có thời gian bắt đầu trong session thì đặt nó
        if (!session()->has("exam_start_time_{$exam->id}")) {
            session(["exam_start_time_{$exam->id}" => now()]);
        }

        $startTime = Carbon::parse(session("exam_start_time_{$exam->id}"));
        $endTime = $startTime->copy()->addMinutes($exam->duration_minutes);

        // Kiểm tra số lần làm bài
        $count = ExamResult::where('user_id', auth()->id())
            ->where('exam_id', $exam->id)
            ->count();

        if ($count >= 3) {
            return redirect()->back()->with('error', 'Bạn đã làm bài thi này quá số lần cho phép.');
        }

        // Lấy danh sách câu hỏi (đã sắp xếp theo thứ tự nếu cần)
        $questions = $exam->questions()->orderBy('question_order')->get();

        // Chuyển sang timestamp để truyền cho Blade
        $startTimestamp = $startTime->timestamp;
        $endTimestamp = $endTime->timestamp;
        $duration = $endTimestamp - $startTimestamp;

        return view('exams.take', compact(
            'exam',
            'questions',
            'startTime',
            'endTime',
            'startTimestamp',
            'endTimestamp',
            'duration'
        ));
    }

    public function submit(Request $request, Exam $exam)
    {
        $score = 0;
        $questions = $exam->questions()->get();

        // Tính điểm và thu thập dữ liệu câu trả lời
        $answers = [];
        foreach ($questions as $question) {
            $userAnswer = $request->input("answers.{$question->id}");

            if ($userAnswer === $question->correct_answer) {
                $score++;
            }

            $answers[] = [
                'question_id' => $question->id,
                'selected_answer' => $userAnswer ?? '',
            ];
        }

        $percentage = round(($score / $questions->count()) * 100, 2);

        // Lưu kết quả bài thi
        $result = ExamResult::create([
            'user_id' => Auth::id(),
            'exam_id' => $exam->id,
            'score' => $score,
            'total' => $questions->count(),
            'percentage' => $percentage,
        ]);

        // Lưu từng câu trả lời
        foreach ($answers as $answer) {
            ExamAnswer::create([
                'exam_result_id' => $result->id,
                'question_id' => $answer['question_id'],
                'selected_answer' => $answer['selected_answer'],
            ]);
        }

        return view('exams.result', compact('score', 'questions', 'percentage'));
    }

}
