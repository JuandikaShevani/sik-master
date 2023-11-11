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
        Schema::create('detail_kartu_keluarga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penduduk_id');
            $table->unsignedBigInteger('kartu_keluarga_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kartu_keluarga');
    }
};
