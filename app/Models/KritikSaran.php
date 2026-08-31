<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;

    protected $fillable = ['pelapor', 'kontak', 'jenis', 'pesan', 'status', 'is_anonymous'];
}
