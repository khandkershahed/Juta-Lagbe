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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('profile_image')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('address_one')->nullable();
            $table->string('address_two')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('company_vat_number')->nullable();
            $table->text('selling_platforms')->nullable();
            $table->string('customer_type')->nullable();
            $table->string('referral_source')->nullable();
            $table->string('buying_group_membership')->nullable();
            $table->string('website_address')->nullable();
            $table->text('buying_group_name')->nullable();
            $table->text('current_suppliers')->nullable();
            $table->string('annual_spend')->nullable();
            $table->string('newsletter_preference')->default('yes')->nullable();
            $table->string('terms_condition')->default('yes')->nullable();
            $table->string('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
