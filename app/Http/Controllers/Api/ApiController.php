<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SpTrans\SpTransController;
use App\Http\Controllers\Weather\WeatherController;

class ApiController extends Controller
{
    public function teste(Request $request)
    {
        $search = $request->all();
        $api = new SpTransController("/Parada/Buscar?termosBusca='ANA ROSA'");
        $result = $api->getContent();

        $apiWeather = new WeatherController($result[0]['py'], $result[0]['px']);
        dd($apiWeather->getWeatherFromCoordinates(), $result);
        //return response()->json($api->getContent(), 200);
    }
}
