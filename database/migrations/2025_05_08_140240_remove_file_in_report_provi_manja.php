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
        Schema::table('report_provi_manja', function (Blueprint $table) {
            // Hapus foreign key constraint dulu
            $table->dropForeign('report_provi_manja_id_file_foreign');

            // Lalu hapus kolomnya
            $table->dropColumn('id_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_provi_manja', function (Blueprint $table) {
            // Tambahkan kembali kolom dan foreign key jika perlu
            $table->unsignedBigInteger('id_file')->nullable();
            $table->foreign('id_file')->references('id')->on('files')->onDelete('cascade');
        });
    }
};
