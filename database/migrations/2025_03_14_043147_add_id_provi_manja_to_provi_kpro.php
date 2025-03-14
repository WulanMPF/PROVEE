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
        Schema::table('report_provi_kpro', function (Blueprint $table) {
            $table->unsignedBigInteger('id_provi_manja')->index();

            // Foreign Key
            $table->foreign('id_provi_manja')->references('id_provi_manja')->on('report_provi_manja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_provi_kpro', function (Blueprint $table) {
            $table->dropForeign(['id_provi_manja']);
            $table->dropColumn('id_provi_manja');
        });
    }
};
