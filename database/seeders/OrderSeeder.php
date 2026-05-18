<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        /*
        | CHỈNH SỬA BƯỚC 5:
        | - orders phụ thuộc customer, branch, booking, employee.
        | - subtotal và grand_total để 0 ban đầu; trigger order_details sẽ tự cập nhật lại.
        */
        DB::table('orders')->insert([
            [
                'order_id' => 1,
                'customer_id' => 1,
                'branch_id' => 1,
                'booking_id' => 1,
                'created_by_emp' => 1,
                'subtotal' => 0,
                'discount_amount' => 0,
                'tax_amount' => 0,
                'grand_total' => 0,
                'status' => 'PENDING',
                'note' => 'Đơn thanh toán cho booking của Milo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'customer_id' => 2,
                'branch_id' => 2,
                'booking_id' => 2,
                'created_by_emp' => 2,
                'subtotal' => 0,
                'discount_amount' => 0,
                'tax_amount' => 0,
                'grand_total' => 0,
                'status' => 'PENDING',
                'note' => 'Đơn thanh toán cho booking của Miu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
