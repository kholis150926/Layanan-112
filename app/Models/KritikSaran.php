<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;

    protected $table = 'kritik_saran';

    protected $fillable = [
        'pelapor',
        'kontak',
        'jenis',
        'pesan',
        'is_anonymous',
        'status',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    /**
     * Scope: pesan yang statusnya masih menunggu.
     */
    public function scopeMenunggu($query)
    {
        return $query->where('status', 'menunggu');
    }
}