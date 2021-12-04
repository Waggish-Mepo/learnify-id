<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('school_id', Auth::user()->school_id)->where('role', User::STUDENT)->get();
    }

    /**
    * @var User $user
    */
    public function map($user): array
    {
        return [
            $user->name,
            $user->nis,
            $user->grade,
            $user->username,
            $user->username,
            $user->email,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIS',
            'Kelas',
            'Username',
            'Password',
            'Email',
        ];
    }
}
