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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('phone');
            $table->string('phone_text')->nullable();
            $table->string('phone_icon')->nullable();
            $table->string('email')->nullable();   // new field
            $table->string('email_text')->nullable();
            $table->string('email_icon')->nullable();   // new field
            $table->string('location');
            $table->string('location_text')->nullable();
            $table->string('location_icon')->nullable(); // new field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
