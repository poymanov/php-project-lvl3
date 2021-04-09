<?php

declare(strict_types=1);

namespace App\UseCases\UrlCheck\Create;

use App\Models\Url;
use App\Models\UrlCheck;
use Exception;

class Handler
{
    public function handle(Command $command)
    {
        $url = Url::find($command->id);

        if (!$url) {
            throw new Exception('URL-адрес не найден');
        }

        $url->checks()->save(new UrlCheck());
    }
}
