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
        Schema::create('layanan112s', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kec')->unique();  // contoh: "64.13.01" — cocok dengan field geojson
            $table->string('kecamatan');            // nama kecamatan
            $table->enum('status', ['launching', 'uji_coba', 'verifikasi', 'pengajuan', 'belum'])
                ->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan112s');
    }
};
