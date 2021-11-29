<?php

namespace App\Service\Database;

use App\Models\Activity;
use App\Models\Question;
use App\Models\School;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class QuestionService{

    public function index($schoolId,  $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 20;
        $activityId = $filter['activity_id'] ?? null;

        School::findOrFail($schoolId);

        $query = Question::orderBy('order', $orderBy);

        if ($activityId !== null) {
            $query->where('activity_id', $activityId);
        }

        $questions = $query->simplePaginate($per_page);

        return $questions->toArray();
    }

    public function detail($schoolId, $questionId)
    {
        School::findOrFail($schoolId);
        $content = Question::findOrFail($questionId);

        return $content;
    }

    public function create($schoolId, $activityId, $payload)
    {
        School::findOrFail($schoolId);
        Activity::findOrFail($activityId);

        $question = new Question();
        $question->id = Uuid::uuid4()->toString();
        $question->activity_id = $activityId;
        $question = $this->fill($question, $payload);
        $question->save();

        return $question->toArray();
    }

    public function update($schoolId, $activityId, $questionId, $payload)
    {
        School::findOrFail($schoolId);
        Activity::findOrFail($activityId);

        $question = Question::findOrFail($questionId);
        $question = $this->fill($question, $payload);
        $question->save();

        return $question->toArray();
    }

    private function fill(Question $question, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $question->$key = $value;
        }

        Validator::make($question->toArray(), [
            'activity_id' => 'required|string',
            'question' => 'required|string',
            'answer' => 'required|string',
            'explanation' => 'required|string',
            'choices' => 'required',
        ])->validate();

        return $question;
    }
}