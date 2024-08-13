<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WindyService;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherController extends Controller
{
    protected $windyService;

    public function __construct(WindyService $windyService)
    {
        $this->windyService = $windyService;
    }

    public function getForecast(Request $request)
    {
        $lat = $request->input('lat');
        $lon = $request->input('lon');

        if (!$lat || !$lon) {
            return response()->json(['error' => 'Latitude and Longitude are required'], 400);
        }

        $forecast = $this->windyService->getForecast($lat, $lon);

        if (!$forecast) {
            return response()->json(['error' => 'Unable to fetch weather data'], 500);
        }

        return response()->json($forecast);
    }


    public function fetchWeather(Request $request)
    {
        try {
            $currentDate = Carbon::now()->format('Y-m-d');
            $url = "https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/bodrum/{$currentDate}/{$currentDate}?unitGroup=metric&key=B89XE7LSKWLUU3KKTJHSXMCMN&contentType=json";
            
            $response = Http::get($url);
            
            return $response->json();
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return response()->json(['error' => 'Failed to fetch weather data'], 500);
        }
    }

    public function showMap()
    {
        return view('map');
    }
}
