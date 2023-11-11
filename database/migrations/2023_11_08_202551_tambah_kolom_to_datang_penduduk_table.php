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
            $table->string('nama_pendatang')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datang_penduduk', function (Blueprint $table) {
            $table->dropColumn('nama_pendatang');
        });
    }
};
