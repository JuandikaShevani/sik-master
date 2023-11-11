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
        Schema::create('kematian_penduduk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penduduk_id');
            $table->date('tanggal_kematian');
            $table->text('penyebab_kematian');
            $table->text('tempat_pemakaman');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kematian_penduduk');
    }
};
