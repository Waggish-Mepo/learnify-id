<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Service\Database\CourseService;
use App\Service\Database\SubjectService;
use App\Service\Database\TopicService;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LessonController extends Controller
{
    public function getSubject() {
        $subjectDB = new SubjectService;
        $schoolId = Auth::user()->school_id;

        $subjects = $subjectDB->index($schoolId,
            [
                'per_page' => 99,
            ],
        );

        return response()->json($subjects['data']);
    }

    public function course(Request $request) {
        $subjectDB = new SubjectService;

        $schoolId = Auth::user()->school_id;

        $subjects = $subjectDB->index($schoolId,
            [
                'per_page' => 99,
            ],
        );

        $subject = $subjectDB->detail($schoolId, $request->subject_id);

        return view('student.course')
        ->with('subject', $subject)
        ->with('subjects', $subjects['data']);
    }

    public function getCourse(Request $request) {
        $courseDB = new CourseService;

        $schoolId = Auth::user()->school_id;

        $courses = $courseDB->index($schoolId,
            [
                'subject_id' => $request->subject_id,
                'per_page' => 99,
            ],
        );

        $courses['total'] = count($courses['data']);

        return response()->json($courses);
    }

    public function topic(Request $request) {
        $subjectDB = new SubjectService;
        $courseDB = new CourseService;
        $topicDB = new TopicService;

        $schoolId = Auth::user()->school_id;

        $subject = $subjectDB->detail($schoolId, $request->subject_id);
        $course = $courseDB->detail($schoolId, $request->course_id);

        $courses = $courseDB->index($schoolId,
            [
                'subject_id' => $request->subject_id,
                'per_page' => 99,
            ],
        );

        return view('student.topic.index')
        ->with('courses', $courses['data'])
        ->with('subject', $subject)
        ->with('course', $course);
    }

    public function getTopic(Request $request) {
        $topicDB = new TopicService;

        $schoolId = Auth::user()->school_id;

        $topics = $topicDB->index($schoolId,
            [
                'subject_id' => $request->subject_id,
                'course_id' => $request->course_id,
                'per_page' => 99,
            ],
        );
        
        $topics['total'] = count($topics['data']);

        return response()->json($topics);
    }
}