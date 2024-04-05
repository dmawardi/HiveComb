<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'url' => $this->faker->url,
            'client_name' => $this->faker->name,
            'completion_date' => $this->faker->date,
            'technologies' => $this->faker->words(3, true),
            'thumbnail_image' => $this->faker->imageUrl,
            'gallery_images' => $this->faker->imageUrl,
            'status' => $this->faker->randomElement(['active', 'inactive', 'archived']),
            'featured' => $this->faker->boolean,
        ];
    }

    /**
     * Indicate that the project is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
        ]);
    }
}
