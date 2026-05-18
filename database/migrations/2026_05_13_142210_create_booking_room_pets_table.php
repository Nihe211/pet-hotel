<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_room_pet', function (Blueprint $table) {
            $table->unsignedBigInteger('booking_room_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('pet_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->dateTimeTz('assigned_at')->useCurrent();
            $table->text('note')->nullable();

            $table->primary(['booking_room_id', 'pet_id'], 'pk_brp');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_room_pet');
    }
};