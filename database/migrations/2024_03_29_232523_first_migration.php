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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('capacity');
            $table->integer('bedrooms');
            $table->foreignId('owner_id')->constrained('owners');
            $table->foreignId('building_id')->constrained('buildings');
            $table->boolean('is_available');
            $table->timestamps();
        });

        Schema::create('owners_contact', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('owners');
            $table->string('contact_type');
            $table->string('username');
            $table->string('link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
        Schema::dropIfExists('owners');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('owners_contact');
    }
};
