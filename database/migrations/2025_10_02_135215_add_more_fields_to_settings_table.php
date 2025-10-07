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
    {
        Schema::table('settings', function (Blueprint $table) {
            //
             $table->string('title')->nullable()->after('site_favicon');
        $table->text('description')->nullable()->change(); // convert string to text
        $table->text('keywords')->nullable()->after('description');

        // Social links
        $table->string('facebook_link')->nullable()->after('keywords');
        $table->string('instagram_link')->nullable()->after('facebook_link');
        $table->string('tiktok_link')->nullable()->after('instagram_link');

        // Google Maps
        $table->text('maps')->nullable()->after('tiktok_link');
        });
    }

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


        Schema::table('settings', function (Blueprint $table) {


            //


             $table->string('title')->nullable()->after('site_favicon');


        $table->text('description')->nullable()->change(); // convert string to text


        $table->text('keywords')->nullable()->after('description');





        // Social links


        $table->string('facebook_link')->nullable()->after('keywords');


        $table->string('instagram_link')->nullable()->after('facebook_link');


        $table->string('tiktok_link')->nullable()->after('instagram_link');





        // Google Maps


        $table->text('maps')->nullable()->after('tiktok_link');


        });


    }





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
>>>>>>> 8415a7a69cbf01bf272a3eff5ceae7bf7c11af48
