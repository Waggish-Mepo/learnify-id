<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Database\SubjectService;
use App\Service\Database\SubjectTeacherService;
use App\Service\Database\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index() {
        $subjectService = new SubjectService;
        $userService = new UserService;
        $schoolId = Auth::user()->school_id;

        $filter = [
            'order_by' => 'ASC',
            'with_subject_teacher' => true,
        ];

        $subjects = $subjectService->index($schoolId, $filter);

        $subjectsWithTeacher = [];
        foreach ($subjects['data'] as $subject) {
            if(!$subject['subject_teacher']) {
                continue;
            }

            $teachers = $userService->bulkDetail($schoolId, $subject['subject_teacher']['teachers'])['data'];
            $subject['teacher_details'] = $teachers;
            $subject['teacher_details_string'] = collect($teachers)->pluck('name')->join(', ');
            $subjectsWithTeacher[] = $subject;
        }

        $filter = [
            'per_page' => 99,
            'role' => 'TEACHER',
        ];

        $teachers = $userService->index($schoolId, $filter)['data'];

        return view('admin.subjects')
            ->with('subjects', $subjectsWithTeacher)
            ->with('teachers', $teachers);
    }

    public function create(Request $request) {
        $subjectService = new SubjectService;
        $subjectTeacherService = new SubjectTeacherService;
        $schoolId = Auth::user()->school_id;

        $payload = [
            'name' => $request->subject_name,
        ];

        $subject = $subjectService->create($schoolId, $payload);

        $payload = [
            'subject_id' => $subject['id'],
            'teachers' => [],
        ];

        $subjectTeacherService->create($schoolId, $payload);

        return redirect()->back();
    }

    public function update(Request $request) {
        $subjectService = new SubjectService;
        $schoolId = Auth::user()->school_id;

        $payload = [
            'name' => $request->subject_name,
        ];

        $subjectService->update($schoolId, $request->subject_id, $payload);

        return redirect()->back();
    }

    public function assign(Request $request) {
        $subjectTeacherService = new SubjectTeacherService;
        $schoolId = Auth::user()->school_id;

        $teachers = collect($request->teacherIds)->unique();

        $payload = [
            'teachers' => $teachers->all(),
        ];

        $subjectTeacher = $subjectTeacherService->update($schoolId, $request->subjectTeacherId, $payload);

        return $subjectTeacher->toArray();
    }
}
