<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mark' => fake()->randomElement($array=['2.0', '3.0', '3.5', '4.0', '4.5', '5.0']),
            'student_id' => fake()->numberBetween(2,40),
            'lecturer_id' => fake()->numberBetween(2,40),
            'subject' => fake()->word,
            'description'=>null,
            'is_valid'=>true
        ];
    }
}
