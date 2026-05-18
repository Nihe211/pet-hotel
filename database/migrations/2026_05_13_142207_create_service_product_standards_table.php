<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_product_standard', function (Blueprint $table) {
            $table->id('standard_id');
            $table->unsignedBigInteger('service_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('product_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->string('species', 30); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->decimal('min_weight_kg', 5, 2);
            $table->decimal('max_weight_kg', 5, 2);
            $table->decimal('usage_amount', 10, 2);
            $table->string('usage_unit', 20); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->text('note')->nullable();
            $table->timestampsTz();

            $table->unique(['service_id', 'product_id', 'species', 'min_weight_kg'], 'uq_sps_logic');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_product_standard');
    }
};