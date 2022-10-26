<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'title' => fake()->text(50),
            'date' => strtotime('+4 days'),
            'time' => strtotime('+4 days'),
            'description' => fake()->text(100),
            'status' => 'UNCOMPLETED'
        ];
    }
}
