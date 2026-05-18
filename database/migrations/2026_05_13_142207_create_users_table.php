<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_user', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('password_hash', 255)->nullable();
            $table->string('role_emp', 20); // CHỈNH SỬA BƯỚC 3: enum -> string, giá trị role xử lý ở file riêng.
            $table->string('user_name', 254)->unique('uq_app_user_username');
            $table->boolean('is_active')->default(true); // CHỈNH SỬA BƯỚC 3: tinyInteger -> boolean.
            $table->dateTimeTz('last_login')->nullable();
            $table->timestampsTz();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index(); // CHỈNH SỬA BƯỚC 3: chỉ khai báo kiểu dữ liệu, không khai báo khóa ngoại.
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('app_user');
    }
};