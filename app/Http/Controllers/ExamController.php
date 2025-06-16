<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use Carbon\Carbon;
use App\Models\ExamResult;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $exams = Exam::with('subject')->get();
    return view('tranggioithieu', compact('exams'));
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

        $startTime = session("exam_start_time_{$exam->id}");
        $endTime = Carbon::parse($startTime)->addMinutes($exam->duration_minutes);

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

    public function take(Exam $exam)
    {
        $questions = $exam->questions()->orderBy('question_order')->get();
        return view('exams.take', compact('exam', 'questions'));
    }

    public function submit(Request $request, Exam $exam)
    {
        $score = 0;
        $questions = $exam->questions;

        foreach ($questions as $question) {
            $userAnswer = $request->input("answers.{$question->id}");
            if ($userAnswer === $question->correct_answer) {
                $score++;
            }
        }

        // Tính phần trăm điểm
        $percentage = round(($score / $questions->count()) * 100, 2);

        // Lưu kết quả vào database
        ExamResult::create([
            'user_id' => Auth::id(),
            'exam_id' => $exam->id,
            'score' => $score,
            'total' => $questions->count(),
            'percentage' => $percentage,
        ]);

        return view('exams.result', compact('score', 'questions', 'percentage'));
    }
}
