<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityResult;
use App\Models\Topic;
use App\Service\Database\CourseService;
use App\Service\Database\SubjectService;
use App\Service\Database\SubjectTeacherService;
use App\Service\Database\TopicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\Database\UserService;

class ProgressController extends Controller
{
    public function progress()
    {
        $userService = new UserService;

        $schoolId = Auth::user()->school_id;
        $userId = Auth::user()->id;

        $user = $userService->detail($schoolId, $userId);
        return view('teacher.progress.index', compact('user'));
    }

    public function detailProgress(Request $request)
    {
        $coruseDB = new CourseService;
        $subjectDB = new SubjectService;
        $studentDB = new UserService;

        $schoolId = Auth::user()->school_id;

        $course = $coruseDB->detail($schoolId, $request->course_id);
        $subject = $subjectDB->detail($schoolId, $request->subject_id);
        $courses = $coruseDB->index(
            $schoolId,
            [
                'subject_id' => $request->subject_id,
                'by_grade' => 1,
            ]
        )['data'];
        $topics =  Topic::where([
            ['subject_id', '=', $request->subject_id],
            ['course_id', '=', $request->course_id],
        ])->get()->toArray();
        $activitiesDB = Activity::where([ 
            ['topic_id', '=', $request->topic_id],
            ['type', '=', 'EXERCISE']
        ])->orderBy('created_at', 'desc')->get();
        $exam = Activity::where([ 
            ['topic_id', '=', $request->topic_id],
            ['type', '=', 'EXAM']
        ])->get();

        $activities = [];
        if(count($activitiesDB)){
            $totalActivity = count($activitiesDB);
            for ($i=0; $i < $totalActivity; $i++) {
                $activityResults = ActivityResult::where('activity_id', '=', $activitiesDB[$i]['id'])->get();
                for ($a=0; $a < count($activityResults); $a++) { 
                    $student = $studentDB->detail($schoolId, $activityResults[$a]['student_id']);
                    $activityName = Activity::where('id', '=', $activityResults[$a]['activity_id'])->value('name');
                    $activityResults[$a]['student_name'] = $student['name'];
                    $activityResults[$a]['student_email'] = $student['email'];
                    $activityResults[$a]['name'] = $activityName;
                    $push = $activityResults->toArray();
                    array_push($activities, $push[0]);
                }
            }
        }else{
            $activityResults = null;
        }
        $no = 1;
        return view('teacher.progress.detail', compact('courses', 'subject', 'course', 'activities', 'no', 'topics'));
    }

    public function index(Request $request)
    {
        $subjectTeacherDB = new SubjectTeacherService;
        $subjectDB = new SubjectService;

        $schoolId = Auth::user()->school_id;
        $teacherId = Auth::user()->id;

        $teacherSubject = $subjectTeacherDB->index(
            $schoolId,
            ['teacher_id' => $teacherId]
        )->toArray();

        $subjectIds = collect($teacherSubject['data'])->pluck('subject_id');

        $subjects = [];
        foreach ($subjectIds as $key => $subjectId) {
            $dataSubject = $subjectDB->detail($schoolId, $subjectId);

            $subjects[$key] = $dataSubject;
        }

        $subject = collect($subjects)
            ->firstWhere('id', $request->subject_id) ?? null;

        return view('teacher.progress.subject', compact('subject', 'subjects'))
            ->with('grades', config('constant.grades'));
    }

    public function detail(Request $request)
    {
        $coruseDB = new CourseService;
        $subjectDB = new SubjectService;

        $schoolId = Auth::user()->school_id;

        $course = $coruseDB->detail($schoolId, $request->course_id);
        $subject = $subjectDB->detail($schoolId, $request->subject_id);
        $courses = $coruseDB->index(
            $schoolId,
            [
                'subject_id' => $request->subject_id,
                'by_grade' => 1,
            ]
        )['data'];

        return view('teacher.progress.course', compact('courses', 'subject', 'course'));
    }

    public function getCourse(Request $request)
    {
        $subjectTeacherDB = new SubjectTeacherService;
        $coruseDB = new CourseService;
        $subjectDB = new SubjectService;

        $schoolId = Auth::user()->school_id;

        if ($request->subject_id !== null) {
            $courses = $coruseDB->index(
                $schoolId,
                [
                    'subject_id' => $request->subject_id,
                    'by_grade' => 1,
                ]
            );
            $courses['total'] = count($courses['data']);
            return response()->json($courses);
        } else {
            $teacherSubject = $subjectTeacherDB->index(
                $schoolId,
                ['teacher_id' => $request->teacher_id]
            )->toArray();

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
    }

    public function getCourseTopic(Request $request)
    {
        $topicDB = new TopicService;

        $schoolId = Auth::user()->school_id;

        $topics = $topicDB->index($schoolId, [
            'subject_id' => $request->subject_id,
            'course_id' => $request->course_id,
        ]);

        $topics['total'] = count($topics['data']);

        return response()->json($topics);
    }
}
