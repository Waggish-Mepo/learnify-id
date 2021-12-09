<?php

namespace App\Service\Database;

use App\Models\Activity;
use App\Models\ActivityResult;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ActivityResultService
{
    public function index($schoolId,  $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $activity_id = $filter['activity_id'] ?? null;
        $student_id = $filter['student_id'] ?? null;

        School::findOrFail($schoolId);

        $query = ActivityResult::orderBy('created_at', $orderBy);

        if ($activity_id !== null) {
            $query->where('activity_id', $activity_id);
        }

        if ($student_id !== null) {
            $query->where('student_id', $student_id);
        }

        $activityResults = $query->simplePaginate($per_page);

        return $activityResults->toArray();
    }

    public function detail($schoolId, $activityResultId)
    {
        School::findOrFail($schoolId);
        $activityResult = ActivityResult::findOrFail($activityResultId);

        return $activityResult->toArray();
    }

    public function create($schoolId, $activityId, $studentId, $payload)
    {
        School::findOrFail($schoolId);
        Activity::findOrFail($activityId);
        User::findOrFail($studentId);

        $activityResult = new ActivityResult;
        $activityResult->id = Uuid::uuid4()->toString();
        $activityResult->activity_id = $activityId;
        $activityResult->student_id = $studentId;
        $activityResult = $this->fill($activityResult, $payload);
        $activityResult->save();

        return $activityResult->toArray();
    }

    public function update($schoolId, $activityId, $studentId, $activityResultId, $payload)
    {
        School::findOrFail($schoolId);
        Activity::findOrFail($activityId);
        User::findOrFail($studentId);

        $activityResult = ActivityResult::findOrFail($activityResultId);
        $activityResult = $this->fill($activityResult, $payload);
        $activityResult->save();

        return $activityResult->toArray();
    }

    private function fill(ActivityResult $activityResult, array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $activityResult->$key = $value;
        }

        Validator::make($activityResult->toArray(), [
            'score' => 'required',
            'answers' => 'required|array',
        ])->validate();

        return $activityResult;
    }
}
