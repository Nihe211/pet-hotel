<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        /*
        | CHỈNH SỬA BƯỚC 5:
        | - customer phụ thuộc app_user qua user_id nên seed sau UserSeeder.
        */
        DB::table('customer')->insert([
            [
                'customer_id' => 1,
                'user_id' => 3,
                'full_name' => 'Nguyễn Ngọc An',
                'email' => 'anna.customer@test.com',
                'phone' => '0901000001',
                'address' => 'Quận 3, TP.HCM',
                'note' => 'Khách quen, thường gửi chó nhỏ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'user_id' => 4,
                'full_name' => 'Trần Gia Bình',
                'email' => 'binh.customer@test.com',
                'phone' => '0901000002',
                'address' => 'Thủ Đức, TP.HCM',
                'note' => 'Ưu tiên phòng yên tĩnh.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 3,
                'user_id' => null,
                'full_name' => 'Lê Minh Châu',
                'email' => 'chau.walkin@test.com',
                'phone' => '0901000003',
                'address' => 'Bình Thạnh, TP.HCM',
                'note' => 'Khách vãng lai.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
