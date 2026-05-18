<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->id('product_category_id');
            $table->string('category_name', 100)->unique('uq_category_product_name');
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};