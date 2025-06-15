<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PaidService;
use App\Models\Revenue;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(20)->create()->each(function ($user) {
            // Gán dịch vụ trả phí cho 10 user ngẫu nhiên
            if (rand(0, 1)) {
                PaidService::create([
                    'user_id' => $user->id,
                    'service_name' => 'Gói cao cấp',
                    'price' => 99000,
                ]);
            }
        });

        // Thêm doanh thu theo quý
        for ($year = 2024; $year <= 2025; $year++) {
            for ($quarter = 1; $quarter <= 4; $quarter++) {
                Revenue::create([
                    'amount' => rand(1000000, 5000000),
                    'source' => 'Dịch vụ tính phí',
                    'created_at' => now()
                        ->setYear($year)
                        ->setMonth(($quarter - 1) * 3 + 1)
                        ->setDay(15),
                ]);
            }
        }

    }
}

