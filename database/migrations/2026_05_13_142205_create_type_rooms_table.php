<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('type_room', function (Blueprint $table) {
            $table->id('type_room_id');
            $table->string('type_name', 30); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->text('note')->nullable();
            $table->unsignedSmallInteger('max_pets');
            $table->decimal('max_weight_kg', 5, 2)->nullable();
            $table->decimal('base_price_per_day', 12, 2)->default(0);
            $table->boolean('is_active')->default(true); // CHỈNH SỬA BƯỚC 3: tinyInteger -> boolean.
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('type_room');
    }
};