<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchInventorySeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: branch_inventory phụ thuộc branch và product. */
        DB::table('branch_inventory')->insert([
            ['inventory_id' => 1, 'branch_id' => 1, 'product_id' => 1, 'quantity_on_hand' => 25.00, 'min_quantity' => 5.00, 'created_at' => now(), 'updated_at' => now()],
            ['inventory_id' => 2, 'branch_id' => 1, 'product_id' => 3, 'quantity_on_hand' => 5000.00, 'min_quantity' => 1000.00, 'created_at' => now(), 'updated_at' => now()],
            ['inventory_id' => 3, 'branch_id' => 2, 'product_id' => 2, 'quantity_on_hand' => 60.00, 'min_quantity' => 10.00, 'created_at' => now(), 'updated_at' => now()],
            ['inventory_id' => 4, 'branch_id' => 2, 'product_id' => 4, 'quantity_on_hand' => 3000.00, 'min_quantity' => 500.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
