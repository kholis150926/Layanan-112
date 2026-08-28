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
        Schema::table('kritik_saran', function (Blueprint $table) {
            $table->string('pelapor')->nullable()->change();
            $table->string('kontak')->nullable()->change();

            $table->string('jenis')->default('kritik')->after('kontak');
            $table->boolean('is_anonymous')->default(false)->after('pesan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kritik_saran', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'is_anonymous']);

            $table->string('pelapor')->nullable(false)->change();
            $table->string('kontak')->nullable(false)->change();
        });
    }
};