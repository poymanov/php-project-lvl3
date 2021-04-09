<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $errors = Session::get('errors');

        if ($errors) {
            flash('Некорректный URL')->error();
        }

        $model = new Url();

        return view('home', compact('model'));
    }
}
