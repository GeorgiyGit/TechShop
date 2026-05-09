<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('carousel');
            $table->string('tag')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('image_path');
            $table->string('image_alt')->nullable();
            $table->string('slide_class')->nullable();
            $table->string('image_class')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->uuid('product_id')->nullable();

            $table->index('carousel');
            $table->index('is_active');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
