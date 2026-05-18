<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        /*
        | CHỈNH SỬA BƯỚC 5:
        | - payments phụ thuộc orders nên seed sau OrderSeeder và OrderDetailSeeder.
        | - Trigger payments sẽ tự cập nhật trạng thái orders: PAID / PARTIAL / PENDING.
        */
        DB::table('payments')->insert([
            [
                'payment_id' => 1,
                'order_id' => 1,
                'payment_method' => 'CASH',
                'provider' => null,
                'amount' => 510000.00,
                'status' => 'SUCCESS',
                'paid_at' => now(),
                'note' => 'Khách thanh toán đủ bằng tiền mặt.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_id' => 2,
                'order_id' => 2,
                'payment_method' => 'BANK_TRANSFER',
                'provider' => 'VCB',
                'amount' => 200000.00,
                'status' => 'SUCCESS',
                'paid_at' => now(),
                'note' => 'Khách đặt cọc một phần.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
