<?php

namespace App\Imports;

use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Ramsey\Uuid\Uuid;

class TeacherImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        $faker = Factory::create();

        if($row['nama']) {
            $username = strtolower(explode(' ', $row['nama'])[0] . $faker->numerify('###'));

            $user = new User([
                'id'  => Uuid::uuid4()->toString(),
                'school_id'  => Auth::user()->school_id,
                'name'  => $row['nama'],
                'username'  => $username,
                'password'  => Hash::make($username),
                'email' => $row['email'],
                'nis'    => null,
                'grade'    => null,
                'role' => User::TEACHER,
                'status' => true,
            ]);

            $user->save();
        }
    }
}
