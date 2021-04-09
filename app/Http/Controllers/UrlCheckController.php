<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Url;
use App\UseCases\UrlCheck\Create;
use Exception;

class UrlCheckController extends Controller
{
    public function store(Url $url)
    {
        $command = new Create\Command();
        $command->id = $url->id;

        try {
            $handler = new Create\Handler();
            $handler->handle($command);

            flash('Страница успешно проверена')->info();
        } catch (Exception $e) {
            flash('Ошибка проверки страницы')->error();
        }

        return redirect(route('url.show', $url));
    }
}
