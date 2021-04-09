<?php

declare(strict_types=1);

namespace App\Services;

use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use DiDom\Query;
use Illuminate\Support\Facades\Http;

class HttpResponseService
{
    /**
     * Получение данных по странице
     *
     * @param string $url
     *
     * @return array
     * @throws InvalidSelectorException
     */
    public function analyze(string $url): array
    {
        $response = Http::get($url);

        $document = new Document($response->body());

        $headerTag      = $document->first('h1');
        $keywordsTag    = $document->first('//meta[contains(@name, "keywords")]', Query::TYPE_XPATH);
        $descriptionTag = $document->first('//meta[contains(@name, "description")]', Query::TYPE_XPATH);

        $headerContent      = $headerTag ? $headerTag->text() : null;
        $keywordsContent    = $keywordsTag ? $keywordsTag->attr('content') : null;
        $descriptionContent = $descriptionTag ? $descriptionTag->attr('content') : null;

        return [
            'statusCode'  => $response->status(),
            'header'      => $headerContent,
            'keywords'    => $keywordsContent,
            'description' => $descriptionContent,
        ];
    }
}
