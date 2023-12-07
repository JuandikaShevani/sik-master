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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->unsignedBigInteger('kartu_keluarga_id');
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('pendidikan');
            $table->string('jenis_pekerjaan');
            $table->string('golongan_darah');
            $table->string('status_perkawinan');
            $table->date('tanggal_perkawinan')->nullable();  //nullable
            $table->string('status_keluarga');
            $table->string('kewarganegaraan');
            $table->string('no_paspor')->nullable();  //nullable
            $table->string('no_kitap')->nullable();  //nullable
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('no_hp')->nullable();  // nullable
            $table->string('path_image')->nullable();  //nullable
            $table->enum('status', ['valid', 'meninggal', 'pindah']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
