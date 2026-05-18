<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet', function (Blueprint $table) {
            $table->id('pet_id');
            $table->unsignedBigInteger('customer_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->string('pet_name', 60);
            $table->string('species', 30);
            $table->string('breed', 60)->nullable();
            $table->string('sex', 10)->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->text('special_note')->nullable();
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet');
    }
};