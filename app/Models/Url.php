<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    public function checks()
    {
        return $this->hasMany(UrlCheck::class);
    }

    public function latestCheck()
    {
        return $this->hasMany(UrlCheck::class)->latest()->first();
    }
}
