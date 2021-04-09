<?php

declare(strict_types=1);

namespace Tests\Feature\UrlCheck;

use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $response = $this->post('/urls/' . $url->id . '/checks');
        $response->assertRedirect('/urls/' . $url->id);

        $this->assertDatabaseHas('url_checks', [
            'url_id' => $url->id,
        ]);
    }
}
