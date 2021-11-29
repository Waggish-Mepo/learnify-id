<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectTeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $schoolId = School::factory()->create()->id;

        return [
            'id' => $this->faker->uuid(),
            'subject_id' => Subject::factory()->create()->id,
            'teachers' => [
                User::factory(['school_id' => $schoolId])->create()->id,
                User::factory(['school_id' => $schoolId])->create()->id,
                User::factory(['school_id' => $schoolId])->create()->id,
            ]
        ];
    }
}
