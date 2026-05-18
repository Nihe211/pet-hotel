<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * CHỈNH SỬA BƯỚC 5:
     * - Seed dữ liệu theo thứ tự bảng cha trước, bảng con sau.
     * - Tắt kiểm tra khóa ngoại trước khi reset dữ liệu để tránh lỗi FK khi truncate.
     * - Bật lại kiểm tra khóa ngoại sau khi seed xong.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->truncateTables();

        Schema::enableForeignKeyConstraints();

        $this->call([
            // Bảng cha / bảng danh mục / bảng nền tảng
            BranchSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            CategoryProductSeeder::class,
            CategoryServiceSeeder::class,
            TypeRoomSeeder::class,

            // Bảng phụ thuộc cấp 1
            EmployeeSeeder::class,
            PetSeeder::class,
            ProductSeeder::class,
            RoomSeeder::class,
            ServiceSeeder::class,

            // Bảng nghiệp vụ chính
            BookingSeeder::class,
            BranchInventorySeeder::class,
            OrderSeeder::class,
            ServiceProductStandardSeeder::class,

            // Bảng nghiệp vụ con
            BookingServicePetSeeder::class,
            PetHealthRecordSeeder::class,
            BookingRoomSeeder::class,

            // Bảng chi tiết, thanh toán, bảng trung gian
            OrderDetailSeeder::class,
            PaymentSeeder::class,
            BookingRoomPetSeeder::class,
        ]);
    }

    private function truncateTables(): void
    {
        /*
        |--------------------------------------------------------------------------
        | CHỈNH SỬA BƯỚC 5: XÓA DỮ LIỆU THEO THỨ TỰ BẢNG CON -> BẢNG CHA
        |--------------------------------------------------------------------------
        | Mục đích:
        | - Tránh lỗi ràng buộc khi database có bật khóa ngoại ở môi trường khác.
        | - Đảm bảo php artisan migrate:fresh --seed có thể chạy lại nhiều lần.
        */
        $tables = [
            'booking_room_pet',
            'payments',
            'order_details',
            'booking_room',
            'pet_health_record',
            'booking_services_pet',
            'service_product_standard',
            'orders',
            'branch_inventory',
            'booking',
            'services',
            'room',
            'product',
            'pet',
            'employee',
            'type_room',
            'category_services',
            'category_product',
            'customer',
            'branch',
            'app_user',
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }
}
