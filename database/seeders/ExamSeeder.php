<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\Subject;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = Subject::all();

        foreach (['THPT', 'DH'] as $level) {
            for ($i = 1; $i <= 5; $i++) {
                $subject = $subjects->random();
                Exam::create([
                    'subject_id' => $subject->id,
                    'exam_code' => $subject->subject_code . '-' . $level . '-' . $i,
                    'level' => $level,
                    'duration_minutes' => 90,
                ]);
            }
        }
    }
}

