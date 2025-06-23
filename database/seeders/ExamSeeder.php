<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy user admin — có thể dựa theo role hoặc ID = 1 nếu local
        $admin = User::where('role', 'admin')->first();

        // Nếu chưa có admin thì thoát
        if (!$admin) {
            $this->command->error('Không tìm thấy người dùng admin!');
            return;
        }

        $subjects = Subject::all();

        foreach (['THPT', 'DH'] as $level) {
            for ($i = 1; $i <= 5; $i++) {
                $subject = $subjects->random();
                Exam::create([
                    'user_id' => $admin->id,
                    'subject_id' => $subject->id,
                    'exam_code' => $subject->subject_code . '-' . $level . '-' . $i,
                    'level' => $level,
                    'duration_minutes' => 90,
                ]);
            }
        }

        $this->command->info('Đã seed 10 đề thi cho admin.');
    }
}