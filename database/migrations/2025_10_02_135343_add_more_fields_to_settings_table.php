<?php

<<<<<<< HEAD
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
=======





use Illuminate\Database\Migrations\Migration;


use Illuminate\Database\Schema\Blueprint;


use Illuminate\Support\Facades\Schema;





return new class extends Migration


{


    /**


     * Run the migrations.


     */


    public function up(): void

>>>>>>> 8415a7a69cbf01bf272a3eff5ceae7bf7c11af48
    {
        Schema::table('settings', function (Blueprint $table) {
            //
             $table->text('description_site')->nullable();
        });
    }

<<<<<<< HEAD
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
=======
    public function down(): void

    {
        Schema::table('settings', function (Blueprint $table) {

        });
    }

};
>>>>>>> 8415a7a69cbf01bf272a3eff5ceae7bf7c11af48
