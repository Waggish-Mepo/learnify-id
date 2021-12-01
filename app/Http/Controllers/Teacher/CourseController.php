<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Service\Database\CourseService;
use App\Service\Database\SubjectService;
use App\Service\Database\SubjectTeacherService;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    public function index(Request $request) {
        $subjectTeacherDB = new SubjectTeacherService;
        $subjectDB = new SubjectService;

        $schoolId = Auth::user()->school_id;
        $teacherId = Auth::user()->id;

        $teacherSubject = $subjectTeacherDB->index($schoolId,
        ['teacher_id' => $teacherId])->toArray();

        $subjectIds = collect($teacherSubject['data'])->pluck('subject_id');

        $subjects = [];
        foreach ($subjectIds as $key => $subjectId) {
            $dataSubject = $subjectDB->detail($schoolId, $subjectId);
            
            $subjects[$key] = $dataSubject;
        }
        
        $subject = collect($subjects)
        ->firstWhere('id', $request->subject_id) ?? null;
        
        return view('teacher.subject', compact('subject', 'subjects'));
    }

    public function getCourse(Request $request) {
        $subjectTeacherDB = new SubjectTeacherService;
        $coruseDB = new CourseService;
        $subjectDB = new SubjectService;

        $schoolId = Auth::user()->school_id;

        $teacherSubject = $subjectTeacherDB->index($schoolId,
        ['teacher_id' => $request->teacher_id])->toArray();

        $subjectIds = collect($teacherSubject['data'])->pluck('subject_id');
        
        $subjects = [];
        foreach ($subjectIds as $key => $subjectId) {
            $dataSubject = $subjectDB->detail($schoolId, $subjectId);
            $dataCourse = $coruseDB->index($schoolId, [
                'subject_id' => $subjectId,
                'by_grade' => 1,
            ])['data'];
            
            $subjects[$key] = $dataSubject;
            $subjects[$key]['courses'] = $dataCourse;
            $subjects[$key]['count_course'] = count($dataCourse);
        }

        return response()->json($subjects);

    }

    public function createCourse(Request $request) {
        $coruseDB = new CourseService;
        $schoolId = Auth::user()->school_id;
        $userId = Auth::user()->id;

        return response()->json($coruseDB->create
        ($schoolId, $request->subject_id,
            [
                'description' => $request->name,
                'created_by' => $userId,
            ]
        ));
    }
}
