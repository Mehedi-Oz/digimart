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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users');
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('sub_category_id')->constrained('sub_categories');
            $table->longText('options')->nullable();
            $table->string('version')->nullable();
            $table->text('demo_link')->nullable();
            $table->json('tags')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('preview_type', ['image', 'video', 'audio'])->nullable();
            $table->string('preview_image')->nullable();
            $table->string('preview_video')->nullable();
            $table->string('preview_audio')->nullable();
            $table->text('main_file');
            $table->boolean('is_main_file_external');
            $table->json('screenshots')->nullable();
            $table->double('price')->default(0)->nullable();
            $table->double('discount_price')->default(0)->nullable();
            $table->boolean('is_supported')->default(0)->nullable();
            $table->text('support_instruction')->nullable();
            $table->enum('status', ['active', 'pending', 'inactive'])->default('pending');
            $table->integer('total_sales')->default(0)->nullable();
            $table->double('total_sale_amount')->default(0)->nullable();
            $table->double('total_earnings')->default(0)->nullable();
            $table->boolean('is_free')->default(0)->nullable();
            $table->boolean('is_trending')->default(0)->nullable();
            $table->boolean('is_best-selling')->default(0)->nullable();
            $table->boolean('is_on_discount')->default(0)->nullable();
            $table->boolean('is_featured')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
