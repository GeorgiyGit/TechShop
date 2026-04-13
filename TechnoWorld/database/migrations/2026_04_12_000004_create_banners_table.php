<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('carousel');
            $table->string('tag');
            $table->string('title');
            $table->text('description');
            $table->string('cta_text');
            $table->string('image_path');
            $table->string('image_alt');
            $table->string('slide_class')->default('carousel-slide-1');
            $table->string('image_class')->default('home-banner-image-appliance');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['carousel', 'is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
