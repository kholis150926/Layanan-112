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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_laporan')->unique();
            $table->string('kecamatan'); // Untuk simpan nama kecamatan (misal: Busang, Sangatta Utara)
            $table->string('kategori');  // Untuk simpan jenis (misal: Kebakaran, Darurat Medis)
            $table->text('lokasi');      // Untuk alamat/lokasi detail
            $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->timestamps();        // Membuat created_at & updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};