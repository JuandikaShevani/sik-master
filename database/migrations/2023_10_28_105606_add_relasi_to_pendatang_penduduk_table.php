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
        Schema::table('datang_penduduk', function (Blueprint $table) {
            $table->foreign('pelapor_id')
                ->references('id')
                ->on('penduduk')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datang_penduduk', function (Blueprint $table) {
            $table->dropForeign('datang_penduduk_pelapor_id');
        });
    }
};
