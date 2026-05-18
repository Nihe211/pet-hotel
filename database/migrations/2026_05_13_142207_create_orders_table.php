<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('customer_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('branch_id'); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->unsignedBigInteger('booking_id')->nullable(); // CHỈNH SỬA BƯỚC 3: booking_id nên nullable vì đơn có thể tạo độc lập.
            $table->unsignedBigInteger('created_by_emp')->nullable(); // CHỈNH SỬA BƯỚC 3: bổ sung đúng cột được model/logic sử dụng.
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0); // CHỈNH SỬA BƯỚC 3: bổ sung kiểu tiền giảm giá.
            $table->decimal('tax_amount', 12, 2)->default(0); // CHỈNH SỬA BƯỚC 3: bổ sung kiểu tiền thuế.
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->string('status', 30); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị enum xử lý ở file riêng.
            $table->text('note')->nullable();
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};