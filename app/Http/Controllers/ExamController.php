<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use Carbon\Carbon;
use App\Models\ExamResult;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamAnswer;
use Illuminate\Support\Facades\DB;

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
        return view('exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Xử lý lưu đề thi và các câu hỏi
            $exam = new Exam();
            $exam->subject_id = $request->subject_id;
            $exam->exam_code = $request->exam_code;
            $exam->level = $request->level;
            $exam->duration_minutes = $request->duration_minutes;
            $exam->user_id = Auth::id();
            $exam->save();

        foreach ($request->questions as $index => $q) {
            DB::table('questions')->insert([
                'exam_id' => $exam->id,
                'question_order' => $index + 1,
                'content' => $q['content'],
                'option_a' => $q['a'],
                'option_b' => $q['b'],
                'option_c' => $q['c'],
                'option_d' => $q['d'],
                'correct_answer' => $q['correct'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        return redirect()->route('exams.my')->with('success', 'Đề thi đã được lưu!');
    }

    public function myExams()
    {
        $exams = Exam::with('subject')
            ->where('user_id', Auth::id())
            ->latest()
            ->get(); 
        return view('exams.my', compact('exams'));
    }

    public function showDetailExam($id)
    {
        $exam = \App\Models\Exam::with('subject', 'questions')->findOrFail($id);
        return view('exams.exam_detail', compact('exam'));
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
    public function editQuestions($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        return view('exams.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateQuestions(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        // Cập nhật thông tin đề thi nếu cần
        $exam->exam_code = $request->exam_code;
        $exam->level = $request->level;
        $exam->duration_minutes = $request->duration_minutes;
        $exam->save();

        // Cập nhật các câu hỏi hiện có
        foreach ($request->existing_questions as $qid => $data) {
            DB::table('questions')->where('id', $qid)->update([
                'content' => $data['content'],
                'option_a' => $data['a'],
                'option_b' => $data['b'],
                'option_c' => $data['c'],
                'option_d' => $data['d'],
                'correct_answer' => $data['correct'],
                'updated_at' => now()
            ]);
        }

        // Thêm câu hỏi mới nếu có
        if ($request->filled('new_questions')) {
            foreach ($request->new_questions as $index => $q) {
                DB::table('questions')->insert([
                    'exam_id' => $exam->id,
                    'question_order' => $index + 1,
                    'content' => $q['content'],
                    'option_a' => $q['a'],
                    'option_b' => $q['b'],
                    'option_c' => $q['c'],
                    'option_d' => $q['d'],
                    'correct_answer' => $q['correct'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        return redirect()->route('exams.my')->with('success', 'Cập nhật đề thi thành công.');
    }

    public function deleteQuestion($examId, $questionId)
    {
        $question = DB::table('questions')
            ->where('id', $questionId)
            ->where('exam_id', $examId)
            ->first();

        if (!$question) {
            return redirect()->back()->with('error', 'Không tìm thấy câu hỏi.');
        }

        DB::table('questions')->where('id', $questionId)->delete();

        return redirect()->back()->with('success', 'Đã xoá câu hỏi thành công.');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exam = Exam::findOrFail($id);

        // Nếu có quan hệ với câu hỏi, hãy xoá luôn
        $exam->questions()->delete();

        $exam->delete();

        return redirect()->route('exams.my')->with('success', 'Đã xoá đề thi thành công.');
    }

    public function list(Request $request)
    {
        $subjectId = $request->query('subject');

        $subjects = \App\Models\Subject::all();

        $exams = \App\Models\Exam::with('subject')
            ->when($subjectId, function ($query, $subjectId) {
                return $query->where('subject_id', $subjectId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('exams.list_exam', compact('exams', 'subjects', 'subjectId'));
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

    public function retake(Exam $exam)
    {
        session()->forget("exam_start_time_{$exam->id}");
        return redirect()->route('exams.take', $exam->id);
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

        return view('exams.result', compact('exam', 'score', 'questions', 'percentage'));
    }

}
