<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingRoomSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: booking_room phụ thuộc booking và room. */
        DB::table('booking_room')->insert([
            [
                'booking_room_id' => 1,
                'booking_id' => 1,
                'room_id' => 1,
                'assigned_at' => now(),
                'note' => 'Phòng tiêu chuẩn cho Milo.',
            ],
            [
                'booking_room_id' => 2,
                'booking_id' => 2,
                'room_id' => 3,
                'assigned_at' => now(),
                'note' => 'Phòng yên tĩnh cho Miu.',
            ],
        ]);
    }
}
