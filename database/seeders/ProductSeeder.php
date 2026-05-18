<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: product phụ thuộc category_product nên seed sau CategoryProductSeeder. */
        DB::table('product')->insert([
            ['product_id' => 1, 'product_category_id' => 1, 'product_name' => 'Hạt chó trưởng thành', 'unit' => 'KG', 'cost_price' => 85000.00, 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 2, 'product_category_id' => 1, 'product_name' => 'Pate mèo vị cá ngừ', 'unit' => 'HOP', 'cost_price' => 22000.00, 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 3, 'product_category_id' => 2, 'product_name' => 'Sữa tắm khử mùi', 'unit' => 'ML', 'cost_price' => 120000.00, 'created_at' => now(), 'updated_at' => now()],
            ['product_id' => 4, 'product_category_id' => 3, 'product_name' => 'Dung dịch sát khuẩn', 'unit' => 'ML', 'cost_price' => 75000.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
