<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HttpResponseService
{
    /**
     * Получение данных по странице
     *
     * @param string $url
     *
     * @return array
     */
    public function analyze(string $url): array
    {
        $response = Http::get($url);

        return [
            'statusCode' => $response->status(),
        ];
    }
}
