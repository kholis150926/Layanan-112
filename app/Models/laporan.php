<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional, untuk memastikan membaca tabel 'laporans')
    protected $table = 'laporans';

    // Kolom-kolom yang diizinkan untuk diisi secara otomatis dari Form/Modal
    protected $fillable = [
        'kode_laporan',
        'kecamatan',
        'kategori',
        'lokasi',
        'status',
    ];
}