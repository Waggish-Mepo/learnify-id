<?php

namespace App\Imports;

use App\Models\User;
use App\Service\Database\ExperienceService;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Ramsey\Uuid\Uuid;

class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        $faker = Factory::create();
        $experienceService = new ExperienceService;

        if($row['nama']) {
            $username = strtolower(explode(' ', $row['nama'])[0] . $faker->numerify('####'));

            $user = new User([
                'id'  => Uuid::uuid4()->toString(),
                'school_id'  => Auth::user()->school_id,
                'name'  => $row['nama'],
                'username'  => $username,
                'password'  => Hash::make($username),
                'email' => $row['email'],
                'nis'    => $row['nis'],
                'grade'    => $row['kelas'],
                'role' => User::STUDENT,
                'status' => true,
            ]);

            $user->save();

            $experienceService->create(Auth::user()->school_id, $user->id, ['grade' => $row['kelas'], 'experience_point' => 0, 'level' => 0]);
        }
    }
}
