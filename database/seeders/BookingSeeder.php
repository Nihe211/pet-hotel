<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: booking phụ thuộc customer và branch. */
        DB::table('booking')->insert([
            [
                'booking_id' => 1,
                'customer_id' => 1,
                'branch_id' => 1,
                'checkin_expected_at' => now()->addDay()->setTime(9, 0),
                'checkout_expected_at' => now()->addDays(3)->setTime(17, 0),
                'checkin_actual_at' => null,
                'checkout_actual_at' => null,
                'status' => 'CONFIRMED',
                'note' => 'Gửi Milo 2 đêm, có tắm sấy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'booking_id' => 2,
                'customer_id' => 2,
                'branch_id' => 2,
                'checkin_expected_at' => now()->addDays(2)->setTime(10, 0),
                'checkout_expected_at' => now()->addDays(4)->setTime(16, 0),
                'checkin_actual_at' => null,
                'checkout_actual_at' => null,
                'status' => 'NEW',
                'note' => 'Miu cần phòng yên tĩnh.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
