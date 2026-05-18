<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        | CHỈNH SỬA BƯỚC 5:
        | - app_user là bảng cha cho customer và employee qua user_id.
        | - password_hash dùng Hash::make để dữ liệu mẫu có thể đăng nhập nếu cần demo.
        */
        DB::table('app_user')->insert([
            [
                'user_id' => 1,
                'user_name' => 'admin@pethotel.test',
                'password_hash' => Hash::make('123456'),
                'role_emp' => 'ADMIN',
                'is_active' => true,
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'user_name' => 'staff.q1@pethotel.test',
                'password_hash' => Hash::make('123456'),
                'role_emp' => 'STAFF',
                'is_active' => true,
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'user_name' => 'customer.anna@pethotel.test',
                'password_hash' => Hash::make('123456'),
                'role_emp' => 'CUSTOMER',
                'is_active' => true,
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'user_name' => 'customer.binh@pethotel.test',
                'password_hash' => Hash::make('123456'),
                'role_emp' => 'CUSTOMER',
                'is_active' => true,
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'user_name' => 'staff.td@pethotel.test',
                'password_hash' => Hash::make('123456'),
                'role_emp' => 'STAFF',
                'is_active' => true,
                'last_login' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
