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
        Schema::create('sektor', function (Blueprint $table) {
            $table->id('id_sektor');
            $table->unsignedBigInteger('id_wilayah')->index();
            $table->string('nama_sektor', 100)->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_wilayah')->references('id_wilayah')->on('wilayah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sektor');
    }
};
