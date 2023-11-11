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
        Schema::create('pindah_penduduk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penduduk_id');
            $table->date('tanggal_pindah');
            $table->text('alamat_tujuan_pindah');
            $table->text('keterangan_pindah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pindah_penduduk');
    }
};
