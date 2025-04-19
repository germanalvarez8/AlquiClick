<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
            $table->string('room_number');
            $table->integer('bed_count');
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('owner_email');
            $table->string('owner_phone');
            $table->string('owner_whatsapp')->nullable();
            $table->json('amenities')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
}; 