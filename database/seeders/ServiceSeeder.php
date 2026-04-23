<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            ['nama_service' => 'Cuci Kering', 'harga_per_kg' => 8000, 'deskripsi' => 'Cuci dan kering pakaian standar'],
            ['nama_service' => 'Cuci Setrika', 'harga_per_kg' => 12000, 'deskripsi' => 'Cuci, kering, dan setrika rapi'],
            ['nama_service' => 'Setrika Saja', 'harga_per_kg' => 5000, 'deskripsi' => 'Layanan setrika saja'],
            ['nama_service' => 'Express 1 Jam', 'harga_per_kg' => 20000, 'deskripsi' => 'Layanan kilat 1 jam'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}