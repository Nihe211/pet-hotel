<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_inventory', function (Blueprint $table) {
            $table->id('inventory_id');
            $table->unsignedBigInteger('branch_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('product_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->decimal('quantity_on_hand', 12, 2)->default(0);
            $table->decimal('min_quantity', 12, 2)->default(0);
            $table->timestampsTz(); // CHỈNH SỬA BƯỚC 3: dùng đủ created_at và updated_at.

            $table->unique(['branch_id', 'product_id'], 'uq_inventory_branch_product');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_inventory');
    }
};