<?php

namespace App\Http\Controllers\Weather;

use Illuminate\Support\Facades\Http;

class WeatherController
{
    protected $lat;
    protected $lon;

    public function __construct($lat, $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getWeatherFromCoordinates()
    {
        $url = env('OPEN_WEATHER_URL');
        $token = env('OPEN_WEATHER_TOKEN');
        $response = Http::get("{$url}lat={$this->lat}&lon={$this->lon}&lang=pt_br&appid={$token}");
        return $response->json();
    }
}
