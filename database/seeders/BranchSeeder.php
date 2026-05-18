<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        /*
        | CHỈNH SỬA BƯỚC 5:
        | - branch là bảng cha, seed trước employee, room, booking, orders, inventory.
        */
        DB::table('branch')->insert([
            [
                'branch_id' => 1,
                'branch_name' => 'Pet Hotel Quận 1',
                'phone' => '02811112222',
                'email' => 'q1@pethotel.test',
                'address' => '12 Nguyễn Trãi, Quận 1, TP.HCM',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'branch_id' => 2,
                'branch_name' => 'Pet Hotel Thủ Đức',
                'phone' => '02833334444',
                'email' => 'thuduc@pethotel.test',
                'address' => '25 Võ Văn Ngân, Thủ Đức, TP.HCM',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
