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
        Schema::create('fan', function (Blueprint $table) {
            $table->id();
            $table->decimal('id_qrcode');
            $table->string('nom');
            $table->string('prenom');
            $table->text('image');
            $table->text('imagecart');
            $table->decimal('nin',18,2);
            $table->text('numero_tele');
            $table->date('date_de_nai');
            $table->text('card');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fans');
    }
};
