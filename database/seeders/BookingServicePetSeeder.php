<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingServicePetSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: booking_services_pet phụ thuộc booking, services, employee, pet. */
        DB::table('booking_services_pet')->insert([
            [
                'booking_service_id' => 1,
                'booking_id' => 1,
                'service_id' => 2,
                'employee_id' => 1,
                'pet_id' => 1,
                'scheduled_at' => now()->addDay()->setTime(14, 0),
                'status' => 'SCHEDULED',
                'note' => 'Tắm sấy Milo sau khi nhận phòng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_service_id' => 2,
                'booking_id' => 2,
                'service_id' => 3,
                'employee_id' => 2,
                'pet_id' => 2,
                'scheduled_at' => now()->addDays(2)->setTime(11, 0),
                'status' => 'PENDING',
                'note' => 'Theo dõi sức khỏe cho Miu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
