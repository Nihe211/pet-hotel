<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('customer_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('branch_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->dateTimeTz('checkin_expected_at')->nullable();
            $table->dateTimeTz('checkout_expected_at')->nullable();
            $table->dateTimeTz('checkin_actual_at')->nullable();
            $table->dateTimeTz('checkout_actual_at')->nullable();
            $table->string('status', 30); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->text('note')->nullable();
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};