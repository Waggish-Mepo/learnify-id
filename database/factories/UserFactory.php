<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->firstName();
        $username = $name.$this->faker->numerify('###');

        $roles = [
            User::ADMIN,
            User::STUDENT,
            User::TEACHER,
        ];

        return [
            'id' => $this->faker->uuid(),
            'school_id' => School::factory()->create()->id,
            'name' => $name,
            'username' => $username,
            'password' => Hash::make($username),
            'role' => $this->faker->randomElement($roles),
            'status' => true,
            'email' => $this->faker->email(),
            'nis' => null,
            'grade' => 12,
        ];
    }
}
