<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Url;
use App\Models\UrlCheck;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Response;

class UrlCheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UrlCheck::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url_id' => Url::factory(),
            'status_code' => $this->faker->randomElement(array_keys(Response::$statusTexts)),
            'h1' => $this->faker->name,
            'keywords' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];
    }
}
