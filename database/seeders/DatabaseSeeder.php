<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $schoolId = School::factory(['name' => 'SMK Indonesia'])->create()->id;

        $users = [
            [
                'name' => 'adminuser',
                'username' => 'admin123',
                'password' => Hash::make('admin123'),
                'role' => User::ADMIN,
                'status' => true,
                'school_id' => $schoolId,
            ],
            [
                'name' => 'teacheruser',
                'username' => 'teacher123',
                'password' => Hash::make('teacher123'),
                'role' => User::TEACHER,
                'status' => true,
                'school_id' => $schoolId,
            ],
            [
                'name' => 'studentuser',
                'username' => 'student123',
                'password' => Hash::make('student123'),
                'role' => User::STUDENT,
                'status' => true,
                'school_id' => $schoolId,
            ],
        ];

        foreach ($users as $user) {
            User::factory($user)->create();
        }

        $subjects = [
            [
                'name' => 'Bahasa Indonesia',
                'school_id' => $schoolId,
            ],
            [
                'name' => 'Matematika',
                'school_id' => $schoolId,
            ],
            [
                'name' => 'Bahasa Sunda',
                'school_id' => $schoolId,
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::factory($subject)->create();
        }

    }
}
