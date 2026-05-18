<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_room', function (Blueprint $table) {
            $table->id('booking_room_id');
            $table->unsignedBigInteger('booking_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('room_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->dateTimeTz('assigned_at')->useCurrent();
            $table->text('note')->nullable();

            $table->unique(['booking_id', 'room_id'], 'uq_booking_room');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_room');
    }
};