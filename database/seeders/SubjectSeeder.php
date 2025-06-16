<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        Subject::create(['subject_code' => 'MATH', 'subject_name' => 'Toán']);
        Subject::create(['subject_code' => 'LIT', 'subject_name' => 'Ngữ văn']);
        Subject::create(['subject_code' => 'ENG', 'subject_name' => 'Tiếng Anh']);
    }
}