<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeRoomSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: type_room là bảng cha của room. */
        DB::table('type_room')->insert([
            [
                'type_room_id' => 1,
                'type_name' => 'STANDARD',
                'note' => 'Phòng tiêu chuẩn cho thú cưng nhỏ.',
                'max_pets' => 2,
                'max_weight_kg' => 15.00,
                'base_price_per_day' => 180000.00,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_room_id' => 2,
                'type_name' => 'VIP',
                'note' => 'Phòng rộng, có camera theo dõi.',
                'max_pets' => 3,
                'max_weight_kg' => 35.00,
                'base_price_per_day' => 350000.00,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
