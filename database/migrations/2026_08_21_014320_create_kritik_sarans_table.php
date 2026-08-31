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
        Schema::create('kritik_sarans', function (Blueprint $table) {
            $table->id(); // <<--- BARIS INI WAJIB ADA UNTUK POSTGRESQL
            $table->string('pelapor')->nullable();
            $table->string('kontak')->nullable();
            $table->string('jenis')->default('saran');
            $table->text('pesan');
            $table->boolean('is_anonymous')->default(false);
            $table->string('status')->default('belum_dibaca');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kritik_sarans');
    }
};