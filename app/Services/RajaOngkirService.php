<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.rajaongkir.base_url');
        $this->apiKey = config('services.rajaongkir.api_key');
    }

    /** 🔹 Ambil semua destinasi domestik (provinsi + kota) */
    public function getDomesticDestinations()
    {
        $response = Http::withHeaders(['key' => $this->apiKey])
            ->get("{$this->baseUrl}/destination/domestic-destination");

        if ($response->successful()) {
            return $response->json()['data'] ?? [];
        }

        return [];
    }

    /** 🔹 Ambil daftar provinsi unik dari destinasi */
    public function getProvinces()
    {
        $destinations = $this->getDomesticDestinations();

        return collect($destinations)
            ->pluck('province_name', 'province_id')
            ->unique()
            ->map(fn($name, $id) => ['province_id' => $id, 'province_name' => $name])
            ->values()
            ->toArray();
    }

    /** 🔹 Ambil kota berdasarkan province_id */
    public function getCities($provinceId)
    {
        $destinations = $this->getDomesticDestinations();

        return collect($destinations)
            ->where('province_id', $provinceId)
            ->map(fn($item) => [
                'city_id' => $item['city_id'],
                'city_name' => $item['city_name'],
            ])
            ->values()
            ->toArray();
    }
}
