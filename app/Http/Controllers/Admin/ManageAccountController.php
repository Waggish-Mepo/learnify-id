<?php

namespace App\Http\Controllers\Admin;

use App\Exports\StudentExport;
use App\Exports\TeacherExport;
use App\Imports\StudentImport;
use App\Imports\TeacherImport;
use App\Http\Controllers\Controller;
use App\Service\Database\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $userDB = new UserService;
        $schoolId = Auth::user()->school_id;

        $payload = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->username,
            'role' => $request->role,
            'email' => $request->email,
            'status' => 1,
        ];

        if ($request->role === 'STUDENT') {
            $payload['nis'] = $request->nis;
            $payload['grade'] = $request->grade;
        }

        if ($request->role === 'TEACHER') {
            $payload['grade'] = $request->grade;
        }

        $create = $userDB->create($schoolId, $payload);

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

        if ($request->role === 'TEACHER') {
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
