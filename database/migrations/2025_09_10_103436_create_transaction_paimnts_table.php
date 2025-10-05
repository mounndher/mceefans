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
        Schema::create('transaction_paimnts', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('id_fan');
            $table->unsignedBigInteger('id_abonment');
            // Other fields
            $table->date('date');
            $table->text('prix');   // 10 digits total, 2 after decimal
            $table->integer('nbrmatch');
             $table->string('statusp')->default('nonp'); // 'p' for paid, 'nonp' for not paid
            $table->string('status'); 
            // Relations (optional if you want foreign key constraints)
            $table->foreign('id_fan')->references('id')->on('fan')->onDelete('cascade');
            $table->foreign('id_abonment')->references('id')->on('abonments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_paimnts');
    }
};
