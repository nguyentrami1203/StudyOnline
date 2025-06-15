<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exam = Exam::where('exam_code', 'MATH2025')->first();

        Question::create([
            'exam_id' => $exam->id,
            'question_order' => 1,
            'content' => '1 + 1 bằng bao nhiêu?',
            'option_a' => '1',
            'option_b' => '2',
            'option_c' => '3',
            'option_d' => '4',
            'correct_answer' => 'B',
        ]);

        Question::create([
            'exam_id' => $exam->id,
            'question_order' => 2,
            'content' => '5 * 6 bằng bao nhiêu?',
            'option_a' => '30',
            'option_b' => '31',
            'option_c' => '28',
            'option_d' => '35',
            'correct_answer' => 'A',
        ]);
    }
}
