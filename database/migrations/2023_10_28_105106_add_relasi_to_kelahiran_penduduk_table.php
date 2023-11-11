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
        Schema::table('kelahiran_penduduk', function (Blueprint $table) {
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
        Schema::table('kelahiran_penduduk', function (Blueprint $table) {
            $table->dropForeign('kelahiran_penduduk_kartu_keluarga_id');
        });
    }
};
