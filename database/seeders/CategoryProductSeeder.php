<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: category_product là bảng cha của product. */
        DB::table('category_product')->insert([
            ['product_category_id' => 1, 'category_name' => 'Thức ăn', 'created_at' => now(), 'updated_at' => now()],
            ['product_category_id' => 2, 'category_name' => 'Sữa tắm', 'created_at' => now(), 'updated_at' => now()],
            ['product_category_id' => 3, 'category_name' => 'Thuốc và vật tư', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
