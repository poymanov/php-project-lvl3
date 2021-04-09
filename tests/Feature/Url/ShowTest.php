<?php

declare(strict_types=1);

namespace Tests\Feature\Url;

use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Успешное отображение страницы конкретного url
     */
    public function testCanBeRendered()
    {
        $url = Url::factory()->create();

        $response = $this->get('/urls/' . $url->id);
        $response->isOk();
        $response->assertSee('ID');
        $response->assertSee('Имя');
        $response->assertSee('Дата создания');
        $response->assertSee('Дата обновления');
    }

    /**
     * Успешное отображение страницы конкретного url
     */
    public function testUrlDataCanBeRendered()
    {
        $url = Url::factory()->create();

        $response = $this->get('/urls/' . $url->id);
        $response->isOk();
        $response->assertSee($url->id);
        $response->assertSee($url->name);
        $response->assertSee($url->created_at);
        $response->assertSee($url->updated_at);
    }
}
