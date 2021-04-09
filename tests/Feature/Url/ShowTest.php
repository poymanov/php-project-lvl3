<?php

declare(strict_types=1);

namespace Tests\Feature\Url;

use App\Models\Url;
use App\Models\UrlCheck;
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

    /**
     * Отображение заголовка и кнопки запуска проверки
     */
    public function testCheckButtonCanBeRendered()
    {
        $url = Url::factory()->create();

        $response = $this->get('/urls/' . $url->id);

        $response->assertSee('Проверки');
        $response->assertSee('Запустить проверку');
    }

    /**
     * Отображение таблицы со списком проверок
     */
    public function testChecksTableCanBeRendered()
    {
        $url = Url::factory()->create();
        $response = $this->get('/urls/' . $url->id);

        $response->assertSee('Код ответа');
        $response->assertSee('h1');
        $response->assertSee('keywords');
        $response->assertSee('description');
    }

    /**
     * Отображение списка проверок сайта
     */
    public function testChecksCanBeRendered()
    {
        $url = Url::factory()->create();

        $firstUrlCheck = UrlCheck::factory()->create(['url_id' => $url->id]);
        $secondUrlCheck = UrlCheck::factory()->create(['url_id' => $url->id]);

        $response = $this->get('/urls/' . $url->id);

        $response->assertSee($firstUrlCheck->status_code);
        $response->assertSee($firstUrlCheck->h1);
        $response->assertSee($firstUrlCheck->keywords);
        $response->assertSee($firstUrlCheck->description);

        $response->assertSee($secondUrlCheck->status_code);
        $response->assertSee($secondUrlCheck->h1);
        $response->assertSee($secondUrlCheck->keywords);
        $response->assertSee($secondUrlCheck->description);
    }
}
