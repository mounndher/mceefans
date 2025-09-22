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
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->text('MAIL_MAILER');
            $table->text('MAIL_HOST');
            $table->text('MAIL_PORT');
            $table->text('MAIL_USERNAME')->nullable();
            $table->text('MAIL_PASSWORD')->nullable();
            $table->text('MAIL_ENCRYPTION')->nullable();
            $table->text('MAIL_FROM_ADDRESS')->nullable();
            $table->text('MAIL_FROM_NAME')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};
