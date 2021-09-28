<?php

namespace App\Http\Controllers\SpTrans\Interfaces;

interface SpTransInterface
{
    public function getContent(): array;
    public function authentication($url, $token): array;
}
