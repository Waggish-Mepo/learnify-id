<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentExport;
use App\Exports\TeacherExport;
use App\Imports\StudentImport;
use App\Imports\TeacherImport;
use App\Http\Controllers\Controller;
use App\Service\Database\ExperienceService;
use App\Service\Database\UserService;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ManageAccountController extends Controller
{
    public function getAccount(Request $request)
    {
        $userDB = new UserService;

        $schoolId = Auth::user()->school_id;

        $accounts = $userDB->index($schoolId, ['role' => $request->role]);

        return response()->json($accounts);
    }

    public function createAccount(Request $request)
    {
        $faker = Factory::create();
        $userDB = new UserService;
        $experienceDB = new ExperienceService;
        $schoolId = Auth::user()->school_id;
        $username = strtolower(explode(' ', $request->name)[0] . $faker->numerify('####'));

        $payload = [
            'name' => $request->name,
            'username' => $username,
            'password' => $username,
            'role' => $request->role,
            'email' => $request->email,
            'status' => 1,
        ];

        if ($request->role === 'STUDENT') {
            $payload['nis'] = $request->nis;
            $payload['grade'] = $request->grade;
        }

        $create = $userDB->create($schoolId, $payload);

        if ($request->role === 'STUDENT') {
            $experienceDB->create($schoolId, $create->id, ['grade' => $payload['grade'] ?? null, 'experience_point' => 0, 'level' => 0]);
        }
        return response()->json($create);
    }

    public function updateAccount(Request $request)
    {
        $userDB = new UserService;
        $schoolId = Auth::user()->school_id;

        $payload = [
            'name' => $request->name,
            'email' => $request->email,
            'status' => (int)$request->status,
        ];

        if ($request->role === 'STUDENT') {
            $payload['nis'] = $request->nis;
            $payload['grade'] = $request->grade;
        }

        $update = $userDB->update($schoolId, $request->id, $payload);

        return response()->json($update);
    }

    public function resetPassword(Request $request)
    {
        $userDB = new UserService;
        $schoolId = Auth::user()->school_id;

        $payload = [
            'password' => $request->username,
        ];

        $update = $userDB->update($schoolId, $request->id, $payload);

        return response()->json($update);
    }

    public function updatePassword(){
        $schoolId = Auth::user()->school_id;
        $userDB = new UserService;

        $currentPassword = Auth::user()->password;
        $oldPassword = request('old_password');

        if(HASH::check($oldPassword, $currentPassword)){
            $userDB->update(
                $schoolId,
                Auth::user()->id,
                ['password' => request('password')]
            );

            return redirect()->back()->with('success', 'Berhasil memperbarui password');
        } else {
            return redirect()->back()->with('warning', 'Gagal memperbarui password');
        }
    }

    public function downloadExcelStudent() {
        $file = public_path()."\assets\\excel\learnify_id_user_import_format_student.xlsx";
        $headers = array('Content-Type: application/xlsx',);
        return response()->download($file, 'learnify_id_user_import_format_student.xlsx', $headers);
    }

    public function downloadExcelTeacher() {
        $file = public_path()."\assets\\excel\learnify_id_user_import_format_teacher.xlsx";
        $headers = array('Content-Type: application/xlsx',);
        return response()->download($file, 'learnify_id_user_import_format_teacher.xlsx', $headers);
    }

    public function importStudent(Request $request) {

        Excel::import(new StudentImport, $request->file('excel-file'));

        return redirect()->back();
    }

    public function importTeacher(Request $request) {

        Excel::import(new TeacherImport, $request->file('excel-file'));

        return redirect()->back();
    }

    public function exportStudent() {
        return Excel::download(new StudentExport, "student_account.xlsx");
    }

    public function exportTeacher() {
        return Excel::download(new TeacherExport, "teacher_account.xlsx");
    }
}
