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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('SET NULL');
            $table->foreignId('shipping_method_id')->nullable()->constrained('shipping_methods')->onDelete('SET NULL');
            $table->double('sub_total')->nullable();
            $table->double('coupon')->nullable();
            $table->double('discount')->nullable();
            $table->double('total_amount')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('shipping_charge')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('status', ['new', 'pending', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'])->default('pending');
            $table->string('shipped_to_different_address')->default('no')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('delivery_location')->nullable();
            $table->string('thana')->nullable(); 
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->text('order_note')->nullable();
            $table->timestamp('order_status_updated_at')->nullable();
            $table->timestamp('order_created_at')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('external_order_id')->nullable();
            $table->text('customer_request')->nullable();
            $table->string('invoice')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('SET NULL');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('SET NULL');
            $table->timestamp('fulfilled_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
