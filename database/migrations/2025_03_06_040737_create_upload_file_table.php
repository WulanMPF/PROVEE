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
<<<<<<< Updated upstream:database/migrations/2025_03_06_040737_create_upload_file_table.php
            $table->foreign('id_user')->references('id_user')->on('user');
=======
            $table->foreign('user_id')->references('user_id')->on('user');
>>>>>>> Stashed changes:database/migrations/2025_03_06_034011_create_upload_file_table.php
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
