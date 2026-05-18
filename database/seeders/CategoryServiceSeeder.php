<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryServiceSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: category_services là bảng cha của services. */
        DB::table('category_services')->insert([
            ['service_category_id' => 1, 'category_name' => 'Lưu trú', 'note' => 'Dịch vụ gửi thú cưng qua ngày.', 'created_at' => now(), 'updated_at' => now()],
            ['service_category_id' => 2, 'category_name' => 'Tắm grooming', 'note' => 'Tắm, sấy, vệ sinh cơ bản.', 'created_at' => now(), 'updated_at' => now()],
            ['service_category_id' => 3, 'category_name' => 'Chăm sóc sức khỏe', 'note' => 'Theo dõi sức khỏe cơ bản.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
