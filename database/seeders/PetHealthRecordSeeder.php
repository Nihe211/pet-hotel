<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetHealthRecordSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: pet_health_record phụ thuộc pet và booking. */
        DB::table('pet_health_record')->insert([
            [
                'health_record_id' => 1,
                'pet_id' => 1,
                'booking_id' => 1,
                'recorded_at' => now(),
                'note' => 'Milo khỏe, ăn uống bình thường.',
                'status' => true,
            ],
            [
                'health_record_id' => 2,
                'pet_id' => 2,
                'booking_id' => 2,
                'recorded_at' => now(),
                'note' => 'Miu hơi nhát, cần theo dõi lúc nhận phòng.',
                'status' => true,
            ],
        ]);
    }
}
