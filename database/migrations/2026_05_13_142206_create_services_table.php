<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->unsignedBigInteger('service_category_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->string('service_name', 120);
            $table->string('species', 30);
            $table->text('description_sv')->nullable();
            $table->decimal('base_price', 12, 2)->default(0);
            $table->unsignedSmallInteger('duration_minutes')->nullable();
            $table->boolean('is_active')->default(true); // CHỈNH SỬA BƯỚC 3: tinyInteger -> boolean.
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};