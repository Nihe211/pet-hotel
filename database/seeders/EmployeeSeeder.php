<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        /*
        | CHỈNH SỬA BƯỚC 5:
        | - employee phụ thuộc app_user và branch nên seed sau UserSeeder, BranchSeeder.
        */
        DB::table('employee')->insert([
            [
                'employee_id' => 1,
                'user_id' => 2,
                'branch_id' => 1,
                'full_name' => 'Phạm Hoàng Nam',
                'salary' => 9000000.00,
                'email' => 'nam.staff@test.com',
                'phone' => '0912000001',
                'hire_date' => '2025-01-10',
                'status_code' => 'WORKING',
                'note' => 'Nhân viên chăm sóc thú cưng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employee_id' => 2,
                'user_id' => 5,
                'branch_id' => 2,
                'full_name' => 'Đỗ Thanh Mai',
                'salary' => 9500000.00,
                'email' => 'mai.staff@test.com',
                'phone' => '0912000002',
                'hire_date' => '2025-03-01',
                'status_code' => 'WORKING',
                'note' => 'Nhân viên grooming.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
