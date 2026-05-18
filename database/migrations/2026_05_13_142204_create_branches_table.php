<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->id('branch_id');
            $table->string('branch_name', 120);
            $table->string('phone', 20)->nullable();
            $table->string('email', 254)->nullable()->unique('uq_branch_email');
            $table->string('address', 255);
            $table->boolean('is_active')->default(true); // CHỈNH SỬA BƯỚC 3: tinyInteger -> boolean vì đây là cờ hoạt động.
            $table->timestampsTz(); // CHỈNH SỬA BƯỚC 3: bổ sung created_at và updated_at chuẩn Laravel.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch');
    }
};