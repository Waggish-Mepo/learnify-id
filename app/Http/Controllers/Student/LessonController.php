<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Service\Database\ActivityResultService;
use App\Service\Database\ActivityService;
use App\Service\Database\ContentService;
use App\Service\Database\CourseService;
use App\Service\Database\QuestionService;
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

    public function detailTopic(Request $request) {
        $subjectDB = new SubjectService;
        $courseDB = new CourseService;
        $topicDB = new TopicService;


        $schoolId = Auth::user()->school_id;

        $subject = $subjectDB->detail($schoolId, $request->subject_id);
        $course = $courseDB->detail($schoolId, $request->course_id);
        $topic = $topicDB->detail($schoolId, $request->topic_id);

        $topics = $topicDB->index($schoolId,
            [
                'subject_id' => $request->subject_id,
                'course_id' => $request->course_id,
                'per_page' => 99,
            ]
        );

        return view('student.topic.detail')
        ->with('subject', $subject)
        ->with('course', $course)
        ->with('topic', $topic)
        ->with('topics', $topics['data']);
    }

    public function getContent(Request $request) {
        $contentDB = new ContentService;
        $schoolId = Auth::user()->school_id;

        $contents = $contentDB->index($schoolId, [
            'topic_id' => $request->topic_id,
            'status' => 'PUBLISHED',
            'order_by' => 'ASC',
        ]);
        $contents['total'] = count($contents['data']);

        return response()->json($contents);
    }

    public function getActivity(Request $request) {
        $activityDB = new ActivityService;
        $schoolId = Auth::user()->school_id;

        $activities = $activityDB->index($schoolId,
            [
                'topic_id' => $request->topic_id,
                'status' => 'PUBLISHED',
            ],
        );

        $data = collect($activities['data'])->groupBy('type');
        $data['total_exam'] = count($data['EXAM'] ?? []);
        $data['total_exercise'] = count($data['EXERCISE'] ?? []);
        
        return response()->json($data);
    }

    public function detailContent(Request $request) {
        $contentDB = new ContentService;
        $schoolId = Auth::user()->school_id;

        $content = $contentDB->detail(
            $schoolId, $request->content_id
        );

        return view('student.topic.content')
            ->with('title', $content['name'])
            ->with('content', $content['content'])
            ->with('subject_id', $request->subject_id)
            ->with('course_id', $request->course_id)
            ->with('topic_id', $request->topic_id)
            ->with('content_id', $request->content_id);
    }

    public function activityStart(Request $request) {
        $activityDB = new ActivityService;
        $topicDB = new TopicService;
        $user = Auth::user();
        
        $activity = $activityDB->detail($user->school_id, $request->activity_id);
        $topic = $topicDB->detail($user->school_id, $request->topic_id);

        return view('student.activity.exercise')
        ->with('subjectId', $request->subject_id)
        ->with('courseId', $request->course_id)
        ->with('user', $user)
        ->with('topic', $topic)
        ->with('activity', $activity);
    }

    public function getQuestion(Request $request) {
        $questionDB = new QuestionService;
        $user = Auth::user();

        $questions = $questionDB->index($user->school_id,
            [
                'activity_id' => $request->activity_id,
                'student_id' => $request->student_id,
                'order_by' => 'asc',
                'per_page' => 99,
            ],
        );

        $questions['total'] = count($questions['data']);

        return response()->json($questions);
    }

    public function finishActivity(Request $request) {
        $activityDB = new ActivityService;
        $activityResultDB = new ActivityResultService;
        $user = Auth::user();
        $totalQuestion = (int)$request->total_question;
        $correctAnswer = (int)$request->correct_answer;
        $activityId = $request->activity_id;

        $score = (100 / $totalQuestion) * $correctAnswer;
        $payload  = [
            'score' => intval($score),
            'answers' => [
                'total_question' => $totalQuestion,
                'correct_answer' => $correctAnswer,
            ],
        ];
        
        $finish = $activityResultDB->create($user->school_id, $activityId, $user->id, $payload);

        return response()->json($finish);
    }
}