<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WindyService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('WINDY_API_KEY');
    }

    public function getForecast($lat, $lon)
    {
        $url = 'https://api.windy.com/api/point-forecast/v2';
        $params = [
            'lat' => $lat,
            'lon' => $lon,
            'model' => 'gfs',
            'parameters' => 'temp,wind',
            'key' => $this->apiKey,
        ];

        $response = Http::get($url, $params);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
