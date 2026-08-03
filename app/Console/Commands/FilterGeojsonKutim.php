<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FilterGeojsonKutim extends Command
{
    protected $signature = 'geojson:filter-kutim';
    protected $description = 'Filter GeoJSON Kalimantan Timur khusus Kabupaten Kutai Timur';

    public function handle()
    {
        $path = storage_path('app/geojson-raw/kaltim-v2.geojson');

        $this->info('Path yang dicek: ' . $path);
        $this->info('File exists? ' . (file_exists($path) ? 'YA' : 'TIDAK'));
        $this->info('File readable? ' . (is_readable($path) ? 'YA' : 'TIDAK'));
        $this->info('File size (filesize): ' . filesize($path) . ' bytes');

        $rawContent = file_get_contents($path);

        $this->info('Ukuran string yang dibaca: ' . strlen($rawContent) . ' bytes');
        $this->info('20 karakter pertama: ' . substr($rawContent, 0, 20));

        $raw = json_decode($rawContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('JSON Error: ' . json_last_error_msg());
            return;
        }

        $filtered = array_values(array_filter(
            $raw['features'],
            fn($f) => $f['properties']['kab_kota'] === 'Kutai Timur'
        ));

        $output = [
            'type' => 'FeatureCollection',
            'name' => 'Kabupaten Kutai Timur',
            'features' => $filtered,
        ];

        file_put_contents(
            storage_path('app/public/geojson/kutai-timur.geojson'),
            json_encode($output)
        );

        $this->info('Selesai. Total kecamatan: ' . count($filtered));
    }
}