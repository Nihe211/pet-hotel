<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id('employee_id');
            $table->unsignedBigInteger('user_id')->nullable(); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('branch_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->string('full_name', 120);
            $table->decimal('salary', 12, 2)->nullable();
            $table->string('email', 254)->nullable()->unique('uq_employee_email');
            $table->string('phone', 20)->unique('uq_employee_phone');
            $table->date('hire_date')->nullable(); // CHỈNH SỬA BƯỚC 3: timestampTz -> date vì ngày tuyển dụng không cần giờ.
            $table->string('status_code', 30); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->text('note')->nullable();
            $table->timestampsTz(); // CHỈNH SỬA BƯỚC 3: bổ sung mốc tạo/cập nhật bản ghi.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};