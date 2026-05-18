<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceProductStandardSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: service_product_standard phụ thuộc services và product. */
        DB::table('service_product_standard')->insert([
            [
                'standard_id' => 1,
                'service_id' => 2,
                'product_id' => 3,
                'species' => 'DOG',
                'min_weight_kg' => 0.00,
                'max_weight_kg' => 10.00,
                'usage_amount' => 40.00,
                'usage_unit' => 'ML',
                'note' => 'Định mức sữa tắm cho chó nhỏ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'standard_id' => 2,
                'service_id' => 3,
                'product_id' => 4,
                'species' => 'ALL',
                'min_weight_kg' => 0.00,
                'max_weight_kg' => 30.00,
                'usage_amount' => 10.00,
                'usage_unit' => 'ML',
                'note' => 'Dùng khi vệ sinh vết trầy nhẹ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
