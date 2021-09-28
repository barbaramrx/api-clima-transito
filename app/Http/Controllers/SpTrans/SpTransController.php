<?php

namespace App\Http\Controllers\SpTrans;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SpTrans\Interfaces\SpTransInterface;

class SpTransController implements SpTransInterface
{
    protected $search;
    public function __construct($search)
    {
        $this->search = $search;
    }


    public function getContent(): array
    {
        $url = env('SP_TRANS_URL');
        $token = env('SP_TRANS_TOKEN');

        $header = $this->authentication($url, $token);
        $response = Http::withHeaders([
            'Cookie' => $header['Set-Cookie'][0]
        ])->get("{$url}{$this->search}");
        return $response->json();
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
    public function authentication($url, $token): array
    {
        $response = Http::post("{$url}/Login/Autenticar?token={$token}");
        $header = $response->getHeaders();

        return $header;
    }
}
