<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->json('options')->nullable();

            $table->string('image_url')->nullable();
            $table->boolean('active')->default(true);

            // ✅ Proper relation
            $table->uuid('location_id');

            $table->timestamps();

            // 🔗 Foreign key
            $table->foreign('location_id')
                  ->references('id')
                  ->on('locations')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
