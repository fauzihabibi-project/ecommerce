<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Cities;
use App\Models\Provinces;

class KomerceRajaOngkirSeeder extends Seeder
{
    public function run(): void
    {
        $apiKey = 'So9cxlIw35f38f6abfada26aZufiPBKS';
        $baseUrl = 'https://rajaongkir.komerce.id/api/v1/destination';

        // ===============================
        // 1️⃣ Ambil data PROVINSI
        // ===============================
        $this->command->info('🔹 Mengambil data provinsi...');
        $provinceResponse = Http::withHeaders(['key' => $apiKey])->get("$baseUrl/province");

        if ($provinceResponse->failed()) {
            $this->command->error('Gagal mengambil data provinsi!');
            return;
        }

        $provinces = $provinceResponse->json('data') ?? [];

        foreach ($provinces as $prov) {
            Provinces::updateOrCreate(
                ['id' => $prov['id']],
                ['name' => $prov['name']]
            );
        }

        $this->command->info('✅ Data provinsi berhasil disimpan.');

        // ===============================
        // 2️⃣ Ambil data KOTA untuk tiap PROVINSI
        // ===============================
        foreach ($provinces as $prov) {
            $provinceId = $prov['id'];
            $this->command->info("🔹 Mengambil data kota dari provinsi ID: {$provinceId}");

            $cityResponse = Http::withHeaders(['key' => $apiKey])->get("$baseUrl/city/$provinceId");

            if ($cityResponse->failed()) {
                $this->command->error("❌ Gagal ambil kota dari provinsi ID {$provinceId}");
                continue;
            }

            $cities = $cityResponse->json('data') ?? [];

            foreach ($cities as $city) {
                Cities::updateOrCreate(
                    ['id' => $city['id']],
                    [
                        'province_id' => $provinceId,
                        'name' => $city['name'],
                    ]
                );
            }
        }

        $this->command->info('✅ Semua data kota berhasil disimpan.');
    }
}
