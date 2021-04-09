<?php

declare(strict_types=1);

namespace Tests\Feature\Url;

use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Попытка добавления сайта с пустым именем
     */
    public function testCreateWithEmptyUrl()
    {
        $response = $this->post('/urls', []);
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Попытка добавления сайта с неправильным значением url
     */
    public function testCreateWithInvalidUrl()
    {
        $response = $this->post('/urls', ['name' => 'test']);
        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Попытка добавления сайта с неправильным значением url
     */
    public function testCreateWithAlreadyExistedUrl()
    {
        $url = Url::factory()->create();

        $response = $this->post('/urls', $url->toArray());
        $response->assertSessionHasErrors(['name']);
    }

    public function testSuccess()
    {
        $url      = Url::factory()->make();
        $response = $this->post('/urls', $url->toArray());
        $response->isRedirect('/');

        $this->assertDatabaseHas('urls', ['name' => $url->name]);
    }
}
