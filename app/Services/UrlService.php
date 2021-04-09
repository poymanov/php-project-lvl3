<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UrlService
{
    /**
     * Получение списка всех сайтов
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return DB::table('urls')->get();
    }
}
