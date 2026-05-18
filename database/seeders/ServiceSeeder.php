<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: services phụ thuộc category_services. */
        DB::table('services')->insert([
            [
                'service_id' => 1,
                'service_category_id' => 1,
                'service_name' => 'Gửi thú cưng qua đêm',
                'species' => 'ALL',
                'description_sv' => 'Dịch vụ lưu trú qua đêm, bao gồm theo dõi cơ bản.',
                'base_price' => 180000.00,
                'duration_minutes' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => 2,
                'service_category_id' => 2,
                'service_name' => 'Tắm sấy chó nhỏ',
                'species' => 'DOG',
                'description_sv' => 'Tắm, sấy, vệ sinh tai móng cho chó nhỏ.',
                'base_price' => 150000.00,
                'duration_minutes' => 60,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => 3,
                'service_category_id' => 3,
                'service_name' => 'Theo dõi sức khỏe cơ bản',
                'species' => 'ALL',
                'description_sv' => 'Ghi nhận ăn uống, cân nặng, dấu hiệu bất thường.',
                'base_price' => 80000.00,
                'duration_minutes' => 30,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
