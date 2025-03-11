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
        Schema::table('upload_file', function (Blueprint $table) {
            $table->enum('ket', ['xpro', 'orbit', 'endstate', 'manja']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upload_file', function (Blueprint $table) {
            $table->dropColumn('ket');
        });
    }
};
