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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori'); // Pengumuman, Kegiatan, Statistik, Edukasi
            $table->string('gambar_url')->nullable(); // Untuk link URL Gambar
            $table->text('ringkasan');
            $table->longText('konten');
            $table->enum('status', ['Dipublikasikan', 'Draft'])->default('Dipublikasikan');
            $table->timestamps(); // Mengisi otomatis created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};