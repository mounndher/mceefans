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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
          
            $table->text('id_qrcode');
            $table->unsignedBigInteger('id_event');
            $table->unsignedBigInteger('idappareil');
            $table->text('present');
            $table->text('status');
            $table->foreign('id_event')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('idappareil')->references('id')->on('appareils')->onDelete('cascade');
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
