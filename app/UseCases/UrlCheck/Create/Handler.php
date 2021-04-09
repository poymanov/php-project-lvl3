<?php

declare(strict_types=1);

namespace App\UseCases\UrlCheck\Create;

use App\Models\Url;
use App\Models\UrlCheck;
use App\Services\HttpResponseService;
use Exception;

class Handler
{
    /** @var HttpResponseService */
    private HttpResponseService $httpResponseService;

    /**
     * @param HttpResponseService $httpResponseService
     */
    public function __construct(HttpResponseService $httpResponseService)
    {
        $this->httpResponseService = $httpResponseService;
    }

    public function handle(Command $command)
    {
        $url = Url::find($command->id);

        if (!$url) {
            throw new Exception('URL-адрес не найден');
        }

        $analyzeData = $this->httpResponseService->analyze($url->name);

        $urlCheck              = new UrlCheck();
        $urlCheck->status_code = $analyzeData['statusCode'];

        $url->checks()->save($urlCheck);
    }
}
