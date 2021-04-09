<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Url\CreateRequest;
use App\Models\Url;
use App\Services\UrlService;
use App\UseCases\Url\Create;

class UrlController extends Controller
{
    private UrlService $urlService;

    /**
     * @param UrlService $urlService
     */
    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function index()
    {
        $urls = $this->urlService->getAll();

        return view('url.index', compact('urls'));
    }

    public function show(Url $url)
    {
        return view('url.show', compact('url'));
    }

    public function store(CreateRequest $request)
    {
        $command       = new Create\Command();
        $command->name = $request->get('name');

        $handler = new Create\Handler();
        $handler->handle($command);

        flash('Страница успешно добавлена')->success();

        return redirect(route('home'));
    }
}
