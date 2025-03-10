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
        Schema::table('report_orbit', function (Blueprint $table) {
            $table->unsignedBigInteger('id_file')->index();

            // Foreign Key
            $table->foreign('id_file')->references('id_file')->on('upload_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_orbit', function (Blueprint $table) {
            $table->dropForeign(['id_file']);
            $table->dropColumn('id_file');
        });
    }
};
