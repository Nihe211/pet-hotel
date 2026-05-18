<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingRoomPetSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: booking_room_pet là bảng trung gian, seed sau booking_room và pet. */
        DB::table('booking_room_pet')->insert([
            [
                'booking_room_id' => 1,
                'pet_id' => 1,
                'assigned_at' => now(),
                'note' => 'Milo được xếp vào phòng Q1-101.',
            ],
            [
                'booking_room_id' => 2,
                'pet_id' => 2,
                'assigned_at' => now(),
                'note' => 'Miu được xếp vào phòng TD-201.',
            ],
        ]);
    }
}
