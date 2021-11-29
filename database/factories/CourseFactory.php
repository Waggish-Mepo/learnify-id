<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'subject_id' => $this->faker->uuid(),
            'created_by' => $this->faker->uuid(),
            'description' => $this->faker->text(24),
            'grade' => $this->faker->numberBetween(1, 12),
        ];
    }
}
