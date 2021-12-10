<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Service\Database\ActivityService;
use App\Service\Database\CourseService;
use App\Service\Database\QuestionService;
use App\Service\Database\SubjectService;
use App\Service\Database\TopicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(Request $request) {
        $activityDB = new ActivityService;
        $subjectDB = new SubjectService;
        $courseDB = new CourseService;
        $topicDB = new TopicService;
        $schoolId = Auth::user()->school_id;

        $activity = $activityDB->detail($schoolId, $request->activity_id);
        $activities = $activityDB->index($schoolId,
            [
                'per_page' => 99,
                'type' => $activity['type'],
                'topic_id' => $request->topic_id,
            ],
        );
        $subject = $subjectDB->detail($schoolId, $request->subject_id);
        $course = $courseDB->detail($schoolId, $request->course_id);
        $topic = $topicDB->detail($schoolId, $request->topic_id);

        return view('teacher.activity.index')
        ->with('subject', $subject)
        ->with('course', $course)
        ->with('topic', $topic)
        ->with('activities', $activities['data'])
        ->with('activity', $activity);
    }

    public function getActivity(Request $request) {
        $activityDB = new ActivityService;
        $schoolId = Auth::user()->school_id;

        $activities = $activityDB->index($schoolId,
            [
                'topic_id' => $request->topic_id,
            ],
        );

        $data = collect($activities['data'])->groupBy('type');
        $data['total_exam'] = count($data['EXAM'] ?? []);
        $data['total_exercise'] = count($data['EXERCISE'] ?? []);

        return response()->json($data);
    }

    public function createActivity(Request $request) {
        $activityDB = new ActivityService;
        $schoolId = Auth::user()->school_id;

        $payload = [
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
            'description' => '-'
        ];

        $create = $activityDB->create($schoolId, $request->topic_id, $payload);

        return response()->json($create);
    }

    public function createQuestion(Request $request) {
        $questionDB = new QuestionService;
        $schoolId = Auth::user()->school_id;

        $questions = $questionDB->index($schoolId,
            [
                'order_by' => 'DESC',
                'per_page' => 1,
                'activity_id' => $request->activity_id
            ],
        )['data'];

        $total = $questions[0]['order'] ?? 0;

        $payload = [
            'question' => $request->question,
            'choices' => $request->choices,
            'answer' => $request->answer,
            'explanation' => $request->explanation,
            'order' => $total + 1,
        ];

        $create = $questionDB->create($schoolId, $request->activity_id, $payload);

        return response()->json($create);
    }

    public function deleteQuestion(Request $request) {
        $questionDB = new QuestionService;
        $schoolId = Auth::user()->school_id;

        $questionDB->destroy($schoolId, $request->activity_id, $request->question_id);

        $questions = $questionDB->index($schoolId,
            [
                'order_by' => 'ASC',
                'per_page' => 99,
                'activity_id' => $request->activity_id
            ],
        )['data'];

        $order = 1;
        foreach($questions as $question) {
            $questionDB->update($schoolId, $request->activity_id, $question['id'], ['order' => $order]);

            $order++;
        }

        return true;
    }

    public function updateQuestion(Request $request) {
        $questionDB = new QuestionService;
        $schoolId = Auth::user()->school_id;

        $payload = [
            'question' => $request->question,
            'choices' => $request->choices,
            'answer' => $request->answer,
            'explanation' => $request->explanation,
        ];

        $update = $questionDB->update($schoolId, $request->activity_id, $request->question_id, $payload);

        return response()->json($update);
    }

    public function getQuestion(Request $request) {
        $questionDB = new QuestionService;
        $schoolId = Auth::user()->school_id;

        $questions = $questionDB->index($schoolId,
            [
                'activity_id' => $request->activity_id,
                'order' => 'ASC'
            ],
        );

        return response()->json($questions);
    }

    public function updateActivity(Request $request) {
        $activityDB = new ActivityService;
        $schoolId = Auth::user()->school_id;
        $time = $request->time !== null ? intval($request->time) : $request->time;
        $experience = $request->experience !== null ? intval($request->experience) : $request->experience;
        $payload = [
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
            'description' => $request->description,
            'time' => $time,
            'experience' => $experience,
        ];

        $update = $activityDB->update($schoolId, $request->topic_id, $request->activity_id, $payload);

        return response()->json($update);
    }
}
