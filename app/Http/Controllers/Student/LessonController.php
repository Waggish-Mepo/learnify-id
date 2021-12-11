<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Service\Database\ActivityResultService;
use App\Service\Database\ActivityService;
use App\Service\Database\ContentResultService;
use App\Service\Database\ContentService;
use App\Service\Database\CourseService;
use App\Service\Database\ExperienceService;
use App\Service\Database\QuestionService;
use App\Service\Database\ScoreService;
use App\Service\Database\SubjectService;
use App\Service\Database\TopicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $experience = Auth::user()->experience;

        $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;

        $subjects = $subjectDB->index($schoolId,
            [
                'per_page' => 99,
            ],
        );

        $subject = $subjectDB->detail($schoolId, $request->subject_id);

        return view('student.course')
        ->with('subject', $subject)
        ->with('experience', $experience)
        ->with('subjects', $subjects['data']);
    }

    public function getCourse(Request $request) {
        $courseDB = new CourseService;

        $schoolId = Auth::user()->school_id;
        $grade = Auth::user()->grade;

        $courses = $courseDB->index($schoolId,
            [
                'subject_id' => $request->subject_id,
                'grade' => $grade,
                'per_page' => 99,
            ],
        );

        $courses['total'] = count($courses['data']);

        return response()->json($courses);
    }

    public function topic(Request $request) {
        $subjectDB = new SubjectService;
        $courseDB = new CourseService;

        $experience = Auth::user()->experience;
        $grade = Auth::user()->grade;

        $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;

        $schoolId = Auth::user()->school_id;

        $subject = $subjectDB->detail($schoolId, $request->subject_id);
        $course = $courseDB->detail($schoolId, $request->course_id);

        $courses = $courseDB->index($schoolId,
            [
                'subject_id' => $request->subject_id,
                'grade' => $grade,
                'per_page' => 99,
            ],
        );

        return view('student.topic.index')
        ->with('courses', $courses['data'])
        ->with('subject', $subject)
        ->with('experience', $experience)
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
        $experience = Auth::user()->experience;

        $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;

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
        ->with('experience', $experience)
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
        $contents['total'] = count($contents['data'] ?? []);
        
        if (isset($contents['total'])) {
            $contentResultDB = new ContentResultService;
            
            $contentResult =[];
            foreach ($contents['data'] as $key => $content) {
                $contentResult[$key] = $content;
                $contentResult[$key]['content_result'] = $contentResultDB->index($schoolId,
                    [
                        'content_id' => $content['id'],
                        'student_id' => Auth::user()->id,
                    ],
                )['data'][0] ?? null;
            }

            $contents['data'] = $contentResult;
        }

        return response()->json($contents);
    }

    public function getActivity(Request $request) {
        $activityDB = new ActivityService;
        $activityResultDB = new ActivityResultService;
        $schoolId = Auth::user()->school_id;
        $userId = Auth::user()->id;

        $activities = $activityDB->index($schoolId,
            [
                'topic_id' => $request->topic_id,
                'status' => 'PUBLISHED',
            ],
        );

        $dataActivity = collect($activities['data'])->groupBy('type');
        $dataActivity['total_exam'] = count($dataActivity['EXAM'] ?? []);
        $dataActivity['total_exercise'] = count($dataActivity['EXERCISE'] ?? []);
        if (isset($dataActivity['EXAM'])) {
            $activityExam =  [];
            $dataExam = $dataActivity['EXAM']->toArray();
            foreach ($dataExam as $key => $activity) {
                $activityExam[$key] = $activity;
                $activityExam[$key]['activity_result'] = $activityResultDB->index($schoolId,
                    [
                        'activity_id' => $activity['id'],
                        'student_id' => $userId,
                    ],
                )['data'][0] ?? null;
            }

            $dataActivity['EXAM'] = $activityExam;
        }

        return response()->json($dataActivity);
    }

    public function detailContent(Request $request) {
        $contentDB = new ContentService;
        $contentResultService = new ContentResultService;
        $schoolId = Auth::user()->school_id;
        $userId = Auth::user()->id;
        $experience = Auth::user()->experience;

        $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;

        $content = $contentDB->detail(
            $schoolId, $request->content_id
        );

        $finished = false;
        $filter = [
            'student_id' => $userId,
            'content_id' => $request->content_id,
        ];

        $result = $contentResultService->index($schoolId, $filter)['data'];

        if($result !== []){
            $finished = true;
        }

        return view('student.topic.content')
            ->with('title', $content['name'])
            ->with('content', $content['content'])
            ->with('finished', $finished)
            ->with('subject_id', $request->subject_id)
            ->with('course_id', $request->course_id)
            ->with('topic_id', $request->topic_id)
            ->with('experience', $experience)
            ->with('content_id', $request->content_id);
    }

    public function finishContent(Request $request) {
        $userId = Auth::user()->id;
        $schoolId = Auth::user()->school_id;
        $experienceId = Auth::user()->experience->id;
        $contentResultService = new ContentResultService;
        $contentService = new ContentService;
        $experienceService = new ExperienceService;

        $create = $contentResultService->create($schoolId, $request->content_id, $userId, ['status' => true]);
        $detail = $contentService->detail($schoolId, $request->content_id);

        $payload = [
            'experience' => $detail['experience'],
        ];

        $experienceService->update($schoolId, $userId, $experienceId, $payload);

        return response()->json($create);
    }

    public function activityStart(Request $request) {
        $activityDB = new ActivityService;
        $topicDB = new TopicService;
        $user = Auth::user();
        $experience = Auth::user()->experience;

        $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;
        $activity = $activityDB->detail($user->school_id, $request->activity_id);
        $topic = $topicDB->detail($user->school_id, $request->topic_id);

        return view('student.activity.exercise')
        ->with('subjectId', $request->subject_id)
        ->with('courseId', $request->course_id)
        ->with('user', $user)
        ->with('topic', $topic)
        ->with('experience', $experience)
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
        $experienceService = new ExperienceService;
        $scoreService = new ScoreService;
        $user = Auth::user();
        $totalQuestion = (int)$request->total_question;
        $correctAnswer = (int)$request->correct_answer;
        $activityId = $request->activity_id;
        $activity = $activityDB->detail($user->school_id, $activityId);
        $score = (100 / $totalQuestion) * $correctAnswer;
        $payload  = [
            'score' => intval($score),
            'answers' => [
                'total_question' => $totalQuestion,
                'correct_answer' => $correctAnswer,
            ],
        ];

        $activityResult = $activityResultDB->index($user->school_id,
            [
                'activity_id' => $activityId,
                'student_id' => $user->id,
            ],
        )['data'][0] ?? null;
        // Untuk Update XP
        $exp = 0;

        if ($activity['type'] === 'EXAM') {

            if ($activityResult === null) {
                $finish = $activityResultDB->create($user->school_id, $activityId, $user->id, $payload);
                $exp += $scoreService->divideExperience($score, $activity['experience']);
                $finish['experience'] = $exp;
            } else {
                $finish = $activityResultDB->detail($user->school_id, $activityResult['id']);
                $finish['score'] = $score;
                $exp += 0;
                $finish['experience'] = $exp;
            }

        } else {
            if ($activityResult === null) {
                $finish = $activityResultDB->create($user->school_id, $activityId, $user->id, $payload);
                $exp += $scoreService->divideExperience($score, $activity['experience']);
                $finish['experience'] = $exp;
            } else {
                $finish = $activityResultDB->update($user->school_id, $activityId, $user->id, $activityResult['id'], $payload);
                // dikurang jadi 10%, karna ini dia udah ngerjain, tapi mau ngerjain lagi, biar ga farming, ato mau di 0 juga gapapa
                $exp += round($scoreService->divideExperience($score, $activity['experience']) * 0.1, 0);
                $finish['experience'] = $exp;
            }
        }

        $payload = [
            'experience' => $exp,
        ];

        $experienceService->update($user->school_id, $user->id, $user->experience->id, $payload);

        return response()->json($finish);
    }
}
