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

            // fan_id as nullable foreign key
            //  $table->foreign('fan_id')->references()->('fans')->onDelete('cascade');
            $table->unsignedBigInteger('fan_id');
            $table->unsignedBigInteger('id_event');
            $table->unsignedBigInteger('idappareil');
            $table->boolean('present')->default(0);
            $table->string('status'); // better than text if it's just short values like checked_in, expired
            $table->foreign('fan_id')->references('id')->on('fan')->onDelete('cascade');
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
