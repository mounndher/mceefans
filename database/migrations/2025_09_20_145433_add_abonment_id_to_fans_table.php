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
        Schema::table('fan', function (Blueprint $table) {
            //
                $table->unsignedBigInteger('id_abonment')->after('id'); 

      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fan', function (Blueprint $table) {
            //
        });
    }
};
