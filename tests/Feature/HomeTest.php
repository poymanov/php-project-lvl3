<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * Отображение главной страницы
     */
    public function testCanBeRendered()
    {
        $response = $this->get('/');
        $response->assertSee('Анализатор страниц');
        $response->assertSee('Бесплатно проверяйте сайты на SEO пригодность');
        $response->isOk();
    }
}
