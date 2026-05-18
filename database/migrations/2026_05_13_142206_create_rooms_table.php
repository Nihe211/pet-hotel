<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room', function (Blueprint $table) {
            $table->id('room_id');
            $table->unsignedBigInteger('branch_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('type_room_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->string('room_number', 20);
            $table->string('status', 30); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->timestampsTz(); // CHỈNH SỬA BƯỚC 3: thêm updated_at ngoài created_at.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};