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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->cascade("set null");
            $table->json('category_id')->nullable();
            $table->string('name',255);
            $table->string('slug',255)->unique();
            $table->string('sku_code')->nullable();
            $table->string('mf_code')->nullable();
            $table->string('product_code')->nullable();
            $table->string('barcode_id')->nullable();
            $table->string('barcode')->nullable();
            $table->json('tags')->nullable();
            $table->json('color')->nullable();
            $table->text('video_link')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('overview')->nullable();
            $table->longText('description')->nullable();
            $table->longText('specification')->nullable();
            $table->string('warranty')->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->integer('box_contains')->nullable();
            $table->double('vat')->nullable();
            $table->double('tax')->nullable();
            $table->double('box_price')->nullable();
            $table->double('box_discount_price')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('unit_discount_price')->nullable();
            $table->string('product_type')->nullable();
            $table->integer('box_stock')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('rating')->nullable();
            $table->string('is_refurbished', 10)->nullable();
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('meta_title')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->date('create_date')->nullable();
            $table->string('added_by')->nullable();
            $table->enum('status', ['published', 'draft', 'inactive'])->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
