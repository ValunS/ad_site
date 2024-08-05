<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [];
        $imageCount = $this->faker->numberBetween(1, 3);
        for ($i = 0; $i < $imageCount; $i++) {
            $images[] = $this->faker->imageUrl();
        }

        return [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->paragraph(5),
            'images' => $images,
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}