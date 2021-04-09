<?php

declare(strict_types=1);

namespace Tests\Feature\UrlCheck;

use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Попытка добавления проверки для несуществующего url
     */
    public function testCreateForNotExistedUrl()
    {
        $response = $this->post('/urls/999/checks');
        $response->assertNotFound();
    }

    /**
     * Успешное создание проверки
     */
    public function testSuccess()
    {
        $url = Url::factory()->create();

        Http::fake([
            '*' => Http::response($this->getFakeResponseBody()),
        ]);

        $response = $this->post('/urls/' . $url->id . '/checks');
        $response->assertRedirect('/urls/' . $url->id);

        $this->assertDatabaseHas('url_checks', [
            'url_id' => $url->id,
        ]);
    }

    /**
     * Создание проверки и получение статуса
     */
    public function testGetStatus()
    {
        $url = Url::factory()->create();

        Http::fake([
            '*' => Http::response($this->getFakeResponseBody(), Response::HTTP_I_AM_A_TEAPOT),
        ]);

        $this->post('/urls/' . $url->id . '/checks');

        $this->assertDatabaseHas('url_checks', [
            'url_id'      => $url->id,
            'status_code' => Response::HTTP_I_AM_A_TEAPOT,
        ]);
    }

    /**
     * Создание проверки и получение seo-данных сайта
     */
    public function testWithSeoData()
    {
        $url = Url::factory()->create();

        Http::fake([
            '*' => Http::response($this->getFakeResponseBody(), Response::HTTP_I_AM_A_TEAPOT),
        ]);

        $this->post('/urls/' . $url->id . '/checks');

        $this->assertDatabaseHas('url_checks', [
            'url_id'      => $url->id,
            'status_code' => Response::HTTP_I_AM_A_TEAPOT,
            'h1'          => 'test header',
            'keywords'    => 'test keywords',
            'description' => 'test description',
        ]);
    }

    /**
     * Получение текста ответа на фейковый запрос
     *
     * @return string
     */
    private function getFakeResponseBody(): string
    {
        return '
            <html>
                <head>
                    <meta name="keywords" content="test keywords">
                    <meta name="description" content="test description">
                </head>
                <body>
                    <h1>test header</h1>
                </body>
            </html>
        ';
    }
}
