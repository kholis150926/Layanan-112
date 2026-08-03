<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Layanan112;

class SeedKecamatanKutim extends Command
{
    protected $signature = 'kecamatan:seed-kutim';
    protected $description = 'Isi tabel dari file geojson Kutai Timur';

    public function handle()
    {
        $path = storage_path('app/public/geojson/kutai-timur.geojson');
        $data = json_decode(file_get_contents($path), true);

        $count = 0;
        foreach ($data['features'] as $feature) {
            $props = $feature['properties'];

            Layanan112::updateOrCreate(
                ['kode_kec' => $props['kode_kec']],
                ['kecamatan' => $props['kecamatan'], 'status' => 'belum']
            );
            $count++;
        }

        $this->info("Selesai. $count kecamatan dimasukkan ke database.");
    }
}