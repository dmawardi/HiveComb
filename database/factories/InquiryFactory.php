<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'company_name' => $this->faker->company,
            'website' => $this->faker->url,
            'type' => $this->faker->randomElement(['general', 'quote', 'support', 'partnership']),
            'message' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['unread', 'read', 'archived', 'in progress', 'resolved', 'closed']),
        ];
    }

    /**
     * Indicate that the inquiry is unread.
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'unread',
        ]);
    }

    /**
     * Indicate that the inquiry is read.
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'read',
        ]);
    }
}
