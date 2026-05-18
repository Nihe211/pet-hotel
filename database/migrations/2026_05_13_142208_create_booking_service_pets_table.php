<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_services_pet', function (Blueprint $table) {
            $table->id('booking_service_id');
            $table->unsignedBigInteger('booking_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('service_id')->nullable(); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('employee_id')->nullable(); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('pet_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->dateTimeTz('scheduled_at')->nullable();
            $table->string('status', 30); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->text('note')->nullable();
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_services_pet');
    }
};