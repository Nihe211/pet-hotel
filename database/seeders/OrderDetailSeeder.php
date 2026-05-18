<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        /*
        | CHỈNH SỬA BƯỚC 5:
        | - order_details phụ thuộc orders, booking_room, booking_services_pet.
        | - line_total vẫn truyền giá trị mẫu, nhưng trigger ở Bước 2 sẽ tự tính lại theo quantity * unit_price.
        | - Sau khi insert, trigger tự cập nhật subtotal và grand_total trong orders.
        */
        DB::table('order_details')->insert([
            [
                'order_detail_id' => 1,
                'booking_room_id' => 1,
                'booking_service_id' => null,
                'order_id' => 1,
                'note' => 'Tiền phòng 2 ngày cho Milo.',
                'quantity' => 2.00,
                'unit_price' => 180000.00,
                'line_total' => 360000.00,
                'created_at' => now(),
            ],
            [
                'order_detail_id' => 2,
                'booking_room_id' => null,
                'booking_service_id' => 1,
                'order_id' => 1,
                'note' => 'Dịch vụ tắm sấy chó nhỏ.',
                'quantity' => 1.00,
                'unit_price' => 150000.00,
                'line_total' => 150000.00,
                'created_at' => now(),
            ],
            [
                'order_detail_id' => 3,
                'booking_room_id' => 2,
                'booking_service_id' => null,
                'order_id' => 2,
                'note' => 'Tiền phòng 2 ngày cho Miu.',
                'quantity' => 2.00,
                'unit_price' => 180000.00,
                'line_total' => 360000.00,
                'created_at' => now(),
            ],
            [
                'order_detail_id' => 4,
                'booking_room_id' => null,
                'booking_service_id' => 2,
                'order_id' => 2,
                'note' => 'Theo dõi sức khỏe cơ bản.',
                'quantity' => 1.00,
                'unit_price' => 80000.00,
                'line_total' => 80000.00,
                'created_at' => now(),
            ],
        ]);
    }
}
