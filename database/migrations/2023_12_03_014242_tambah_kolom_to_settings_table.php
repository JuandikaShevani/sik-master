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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->string('deskripsi_singkat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('path_image_bg')->after('path_image')->nullable();
            $table->string('path_image_bg2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['email', 'deskripsi_singkat', 'no_hp', 'path_image_bg', 'path_image_bg2']);
        });
    }
};
