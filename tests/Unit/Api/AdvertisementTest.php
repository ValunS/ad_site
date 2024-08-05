<?php

namespace Tests\Unit\Api;

use App\Models\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Создание тестовых объявлений
        Advertisement::factory()->count(10)->create();
    }

    /**
     * Тест получения списка объявлений.
     *
     * @return void
     */
    public function test_index_advertisement()
    {
        // Выполнение GET-запроса к API-эндпоинту
        $response = $this->get('/api/advertisements');

        // Проверка, что ответ имеет статус 200
        $response->assertStatus(200);

        // Проверка, что ответ содержит ожидаемые данные
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'main_image',
                    'price',
                ],
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'links',
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);
    }

    /**
     * Тест создания объявления.
     *
     * @return void
     */
    public function test_store_advertisement()
    {
        // Данные для создания объявления
        $data = [
            'title' => 'Test Advertisement',
            'description' => 'This is a test advertisement description.',
            'images' => [
                'https://example.com/image1.jpg',
                'https://example.com/image2.jpg',
            ],
            'price' => 99.99,
        ];

        // Выполнение POST-запроса к API-эндпоинту
        $response = $this->post('/api/advertisements', $data);

        // Проверка, что ответ имеет статус 201
        $response->assertStatus(201);

        // Проверка, что объявление было создано в базе данных
        $this->assertDatabaseHas('advertisements', [
            'title' => 'Test Advertisement',
            'description' => 'This is a test advertisement description.',
            'price' => 99.99,
        ]);

        // Проверка, что ответ содержит ожидаемые данные
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'main_image',
                'price',
            ],
        ]);
    }

    /**
     * Тест получения объявления.
     *
     * @return void
     */
    public function test_show_advertisement()
    {
        // Получение тестового объявления из базы данных
        $advertisement = Advertisement::first();

        // Выполнение GET-запроса к API-эндпоинту
        $response = $this->get('/api/advertisements/' . $advertisement->id);

        // Проверка, что ответ имеет статус 200
        $response->assertStatus(200);

        // Проверка, что ответ содержит ожидаемые данные
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'main_image',
                'price',
            ],
        ]);
    }
}