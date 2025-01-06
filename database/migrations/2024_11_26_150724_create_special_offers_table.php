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
        Schema::create('special_offers', function (Blueprint $table) {
            $table->id();
            $table->json('product_id')->nullable();//
            $table->string('name')->nullable();//
            $table->string('slug')->nullable();//
            $table->string('button_name')->nullable();//
            $table->text('button_link')->nullable();//
            $table->text('header_slogan')->nullable();//

            $table->timestamp('start_date')->nullable(); // Using timestamp for date and time
            $table->timestamp('end_date')->nullable(); // Using timestamp for date and time
            $table->timestamp('date')->nullable(); // Using timestamp for date and time

            $table->string('image')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('footer_banner')->nullable();
            $table->string('logo')->nullable();

            $table->string('status')->nullable();
            $table->string('is_header')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_offers');
    }
};
