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
        Schema::create('successes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('image');
            $table->text('descrition');
            $table->string('pharse1');
            $table->text('textpharse1');
            $table->string('pharse2');
            $table->text('textpharse2');
            $table->string('pharse3');
            $table->text('textpharse3');
            $table->string('pharse4');
            $table->text('textpharse4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('successes');
    }
};
