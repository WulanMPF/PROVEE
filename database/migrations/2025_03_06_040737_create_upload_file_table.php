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
        Schema::create('upload_file', function (Blueprint $table) {
            $table->id('id_file');
            $table->unsignedBigInteger('id_user')->index();
            $table->string('nama_file');
            $table->string('path_file');
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_user')->references('id_user')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_file');
    }
};
