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
        Schema::table('detail_kartu_keluarga', function (Blueprint $table) {
            $table->foreign('penduduk_id')
                ->references('id')
                ->on('penduduk')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('kartu_keluarga_id')
                ->references('id')
                ->on('kartu_keluarga')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_kartu_keluarga', function (Blueprint $table) {
            $table->dropForeign('detail_kartu_keluarga_penduduk_id_foreign');
            $table->dropForeign('detail_kartu_keluarga_kartu_keluarga_id_foreign');
        });
    }
};
