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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('bigtitle');
            $table->text('decription');
            $table->text('linge1');
            $table->text('subtitle1');
            $table->text('linge2');
            $table->text('subtitle2');
            $table->text('linge3');
            $table->text('subtitle3');
            $table->text('linge4');
             $table->text('subtitle4');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
