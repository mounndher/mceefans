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
        //
          Schema::table('transaction_paimnts', function (Blueprint $table) {
            $table->dropForeign(['id_fan']);
            $table->dropForeign(['id_abonment']);

            $table->foreign('id_fan')
                  ->references('id')->on('fan')
                  ->onDelete('restrict');

            $table->foreign('id_abonment')
                  ->references('id')->on('abonments')
                  ->onDelete('restrict');
        });

        // attendances
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['fan_id']);
            $table->dropForeign(['id_event']);
            $table->dropForeign(['idappareil']);

            $table->foreign('fan_id')
                  ->references('id')->on('fan')
                  ->onDelete('restrict');

            $table->foreign('id_event')
                  ->references('id')->on('events')
                  ->onDelete('restrict');

            $table->foreign('idappareil')
                  ->references('id')->on('appareils')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_paimnts', function (Blueprint $table) {
            $table->dropForeign(['id_fan']);
            $table->dropForeign(['id_abonment']);

            $table->foreign('id_fan')
                  ->references('id')->on('fan')
                  ->onDelete('cascade');

            $table->foreign('id_abonment')
                  ->references('id')->on('abonments')
                  ->onDelete('cascade');
        });

        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['fan_id']);
            $table->dropForeign(['id_event']);
            $table->dropForeign(['idappareil']);

            $table->foreign('fan_id')
                  ->references('id')->on('fan')
                  ->onDelete('cascade');

            $table->foreign('id_event')
                  ->references('id')->on('events')
                  ->onDelete('cascade');

            $table->foreign('idappareil')
                  ->references('id')->on('appareils')
                  ->onDelete('cascade');
                  });
    }
};
