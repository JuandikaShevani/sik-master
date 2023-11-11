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
        Schema::create('datang_penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->unsignedBigInteger('pelapor_id');
            $table->date('tanggal_datang');
            $table->text('asal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datang_penduduk');
    }
};
