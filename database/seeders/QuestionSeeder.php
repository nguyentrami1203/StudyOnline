<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $exams = Exam::all();

        foreach ($exams as $exam) {
            for ($i = 1; $i <= 50; $i++) {
                $a = rand(1, 20);
                $b = rand(1, 20);
                $correct = $a + $b;

                $options = [
                    'A' => $correct,
                    'B' => $correct + rand(1, 5),
                    'C' => $correct - rand(1, 3),
                    'D' => $correct + rand(6, 10),
                ];
                $shuffled = collect($options)->shuffle();
                $correctOptionKey = $shuffled->search($correct);

                Question::create([
                    'exam_id' => $exam->id,
                    'question_order' => $i,
                    'content' => "$a + $b bằng bao nhiêu?",
                    'option_a' => $shuffled->values()[0],
                    'option_b' => $shuffled->values()[1],
                    'option_c' => $shuffled->values()[2],
                    'option_d' => $shuffled->values()[3],
                    'correct_answer' => strtoupper(chr(65 + $correctOptionKey)), // A/B/C/D
                ]);
            }
        }
    }
}
