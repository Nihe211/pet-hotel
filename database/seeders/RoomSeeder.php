<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: room phụ thuộc branch và type_room. */
        DB::table('room')->insert([
            ['room_id' => 1, 'branch_id' => 1, 'type_room_id' => 1, 'room_number' => 'Q1-101', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 2, 'branch_id' => 1, 'type_room_id' => 2, 'room_number' => 'Q1-VIP1', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['room_id' => 3, 'branch_id' => 2, 'type_room_id' => 1, 'room_number' => 'TD-201', 'status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
