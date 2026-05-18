<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id('customer_id');
            $table->unsignedBigInteger('user_id')->nullable(); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->string('full_name', 120);
            $table->string('email', 254)->nullable()->unique('uq_customer_email');
            $table->string('phone', 20)->unique('uq_customer_phone');
            $table->string('address', 255)->nullable();
            $table->text('note')->nullable();
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};