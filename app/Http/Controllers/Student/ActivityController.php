<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Service\Database\ActivityService;
use App\Service\Database\CourseService;
use App\Service\Database\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(Request $request) {
        $activityDB = new ActivityService;

        $schoolId = Auth::user()->school_id;

        $activity = $activityDB->detail($schoolId, $request->activity_id);

        if ($activity['type'] === 'EXERCISE') {
            return view('student.activity.exercise')
                ->with('subject_id', $request->subject_id)
                ->with('course_id', $request->course_id)
                ->with('topic_id', $request->topic_id)
                ->with('activity', $request->activity);
        }

        if ($activity['type'] === 'EXAM') {
            return view('student.activity.exam')
                ->with('subject_id', $request->subject_id)
                ->with('course_id', $request->course_id)
                ->with('topic_id', $request->topic_id)
                ->with('activity', $request->activity);
        }
    }

    public function getQuestion(Request $request) {
        $questionDB = new QuestionService;

        $schoolId = Auth::user()->school_id;

        $questions = $questionDB->index($schoolId,
            [
                'activity_id' => $request->activity_id,
                'order' => 'DESC'
            ],
        );

        return response()->json($questions);
    }

    public function submitQuestion(Request $request) {
        $questionDB = new QuestionService;

        $schoolId = Auth::user()->school_id;

        $questions = $questionDB->index($schoolId,
            [
                'activity_id' => $request->activity_id,
                'order' => 'DESC'
            ],
        );

        $correctAnswer = 0;
        $studentAnswer = $request->answers;

        foreach($questions['data'] as $key => $question) {
            if (intval($studentAnswer[$key]['no'] + 1) === $question['order'] && 
                $studentAnswer[$key]['answer'] === $question['answer']) 
            {
                $correctAnswer++;
            }
        }

        dd($studentAnswer, $questions['data'], $correctAnswer);
    }
}
