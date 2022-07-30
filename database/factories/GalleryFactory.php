<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(10),
            'description' => $this->faker->realText(),
            'cover_image' => 'placeholder.jpg',
            'thumbnail_image' => 'placeholder.jpg',
        ];
    }
}
