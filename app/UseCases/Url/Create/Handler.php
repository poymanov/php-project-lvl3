<?php

declare(strict_types=1);

namespace App\UseCases\Url\Create;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Handler
{
    public function handle(Command $command)
    {
        DB::table('urls')->insert([
            'name' => $command->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
