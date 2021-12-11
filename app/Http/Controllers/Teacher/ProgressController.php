<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityResult;
use App\Models\Content;
use App\Models\ContentResult;
use App\Models\Notif;
use App\Models\Topic;
use App\Service\Database\CourseService;
use App\Service\Database\SubjectService;
use App\Service\Database\SubjectTeacherService;
use App\Service\Database\TopicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\Database\UserService;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

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
        $topicDB = new TopicService;

        $schoolId = Auth::user()->school_id;

        $course = $coruseDB->detail($schoolId, $request->course_id);
        $subject = $subjectDB->detail($schoolId, $request->subject_id);
        $topic = $topicDB->detail($schoolId, $request->topic_id);
        $topics =  Topic::where([
            ['subject_id', '=', $request->subject_id],
            ['course_id', '=', $request->course_id],
        ])->get()->toArray();

        // activity result
        $activitiesDB = Activity::where([
            ['topic_id', '=', $request->topic_id],
            ['type', '=', 'EXERCISE']
        ])->orderBy('created_at', 'desc')->get();
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
            $activities = null;
        }

        // content result
        $contentsDB = Content::where('topic_id', '=', $request->topic_id)->orderBy('created_at', 'desc')->get();
        $contents = [];
        if(count($contentsDB)){
            $totalContent = count($contentsDB);
            for ($i = 0; $i < $totalContent; $i++) {
                $contentResults = ContentResult::where('content_id', '=', $contentsDB[$i]['id'])->get();
                for ($a = 0; $a < count($contentResults); $a++) {
                    $student = $studentDB->detail($schoolId, $contentResults[$a]['student_id']);
                    $contentName = Content::where('id', '=', $contentResults[$a]['content_id'])->value('name');
                    $contentResults[$a]['student_name'] = $student['name'];
                    $contentResults[$a]['student_email'] = $student['email'];
                    $contentResults[$a]['name'] = $contentName;
                    $push = $contentResults->toArray();
                    array_push($contents, $push[0]);
                }
            }
        }else{
            $contents = null;
        }

        // exam result
        $examsDB = Activity::where([
            ['topic_id', '=', $request->topic_id],
            ['type', '=', 'EXAM']
        ])->get();
        $exams = [];
        if(count($examsDB)){
            $totalExam = count($examsDB);
            for ($i = 0; $i < $totalExam; $i++) {
                $examResults = ActivityResult::where('activity_id', '=', $examsDB[$i]['id'])->get();
                for ($a = 0; $a < count($examResults); $a++) {
                    $student = $studentDB->detail($schoolId, $examResults[$a]['student_id']);
                    $examName = Activity::where('id', '=', $examResults[$a]['activity_id'])->value('name');
                    $examResults[$a]['student_name'] = $student['name'];
                    $examResults[$a]['student_email'] = $student['email'];
                    $examResults[$a]['name'] = $examName;
                    $push = $examResults->toArray();
                    array_push($exams, $push[0]);
                }
            }
        }else{
            $exams = null;
        }
        $no = 1;
        return view('teacher.progress.detail', compact('subject', 'course', 'activities', 'contents', 'exams', 'no', 'topics', 'topic'));
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

    public function sendNotif($activity_id){
        
        $examsDB = ActivityResult::where(['activity_id'=>$activity_id])->get();

        foreach ($examsDB as $key => $value) {
            $notif = new Notif;
            $notif->student_id= $value->student_id;
            $notif->teacher_id= Auth::id();
            $notif->title= "Nilai Ulangan";
            $notif->message= "Kamu mendapatkan nilai ".$value->score;
            $notif->is_send= 1;
            $notif->save();
        }
        return redirect()->back();
        
    }
}
