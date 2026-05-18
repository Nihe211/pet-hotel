<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_health_record', function (Blueprint $table) {
            $table->id('health_record_id');
            $table->unsignedBigInteger('pet_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('booking_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->dateTimeTz('recorded_at')->useCurrent();
            $table->text('note')->nullable();
            $table->boolean('status')->default(true); // CHỈNH SỬA BƯỚC 3: tinyInteger -> boolean vì đây là cờ trạng thái bản ghi.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_health_record');
    }
};