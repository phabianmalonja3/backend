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
        Schema::create('bookings', function (Blueprint $table) {
    $table->uuid('id')->primary(); 
    
    // Relationship using UUID
    $table->foreignUuid('package_id')->constrained('packages');
    
    // Traveler Info
    $table->string('first_name');
    $table->string('last_name');
    $table->string('email');
    
    // JSON Data
    $table->json('guest_counts'); // {"adults": 1, "youth": 0, "children": 0}
    
    // Booking Details
    $table->date('travel_date');
    $table->decimal('total_price', 10, 2);
    $table->string('status')->default('pending'); // pending, confirmed, cancelled
    
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
