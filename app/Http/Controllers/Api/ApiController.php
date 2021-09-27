<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getContent()
    {
        $url = env('SP_TRANS_URL');
        $token = env('SP_TRANS_TOKEN');

        $this->authentication($url, $token);

        $response = Http::get("{$url}/Parada/Buscar?termosBusca=Afonso");
        return response()->json($response->json(), 200);
    }

    /**
     * Método de autenticação no servidor da API.
     *
     * É realizado uma requisição do tipo post para o servidor da API que retorna
     * no cabeçalho as informações do cookie de autenticação da API.
     *
     * @param string $url
     * @param string $token
     * @return void
     */
    private function authentication($url, $token)
    {
        $response = Http::post("{$url}/Login/Autenticar?token={$token}");
        $header = $response->getHeaders();
        $header = explode(';', $header['Set-Cookie'][0]);
        $cookie = explode('=', $header[0]);
        $name = $cookie[0];
        $credential = $cookie[1];
        setcookie(
            $name,
            $credential,
            0,
            "/api",
            "localhost",
            false,
            true
        );
    }
}
