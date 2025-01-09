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
            'mark' => fake()->randomElement($array=['2', '3', '3.5', '4', '4.5', '5']),
            'student_id' => fake()->numberBetween(6,13),
            'lecturer_id' => fake()->numberBetween(2,5),
            'subject' => fake()->randomLetter,
            'description'=>null,
            'is_valid'=>true
        ];
    }
}
