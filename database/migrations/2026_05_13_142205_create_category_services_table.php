<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_services', function (Blueprint $table) {
            $table->id('service_category_id');
            $table->string('category_name', 80)->unique('uq_category_services_name');
            $table->text('note')->nullable();
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_services');
    }
};