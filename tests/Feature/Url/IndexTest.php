<?php

declare(strict_types=1);

namespace Tests\Feature\Url;

use App\Models\Url;
use App\Models\UrlCheck;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Успешное отображение страницы с url
     */
    public function testCanBeRendered()
    {
        $response = $this->get('/urls');
        $response->isOk();
        $response->assertSee('ID');
        $response->assertSee('Имя');
        $response->assertSee('Последняя проверка');
        $response->assertSee('Код ответа');
    }

    /**
     * Отображение списка url
     */
    public function testShowUrls()
    {
        $firstUrl  = Url::factory()->create();
        $secondUrl = Url::factory()->create();

        $response = $this->get('/urls');
        $response->assertSee($firstUrl->id);
        $response->assertSee($firstUrl->name);

        $response->assertSee($secondUrl->id);
        $response->assertSee($secondUrl->name);
    }

    /**
     * Отображение даты последней проверки url
     */
    public function testUrlLastCheckDate()
    {
        $url = Url::factory()->create();

        $firstUrlCheck  = UrlCheck::factory()->create(['url_id' => $url->id]);
        $secondUrlCheck = UrlCheck::factory()->create(['url_id' => $url->id, 'created_at' => Carbon::now()->addHour()]);

        $response = $this->get('/urls');

        $response->assertSee($secondUrlCheck->created_at);
        $response->assertDontSee($firstUrlCheck->created_at);
    }

    /**
     * Отображение статуса последней проверки url
     */
    public function testUrlLastCheckStatus()
    {
        $url = Url::factory()->create();

        $firstUrlCheck  = UrlCheck::factory()->create(['url_id' => $url->id]);
        $secondUrlCheck = UrlCheck::factory()->create(['url_id' => $url->id, 'created_at' => Carbon::now()->addHour()]);

        $response = $this->get('/urls');

        $response->assertSee($secondUrlCheck->created_at);
        $response->assertSee($secondUrlCheck->status_code);
        $response->assertDontSee($firstUrlCheck->created_at);
    }
}
