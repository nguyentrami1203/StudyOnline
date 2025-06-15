<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\Subject;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $math = Subject::where('subject_code', 'MATH')->first();
        Exam::create([
            'subject_id' => $math->id,
            'exam_code' => 'MATH2025',
            'level' => 'THPT',
            'duration_minutes' => 90,
        ]);
    }
}
