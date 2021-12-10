<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
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
            'course_id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'order' => $this->faker->numberBetween(1, 20),
        ];
    }
}
