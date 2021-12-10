<?php

namespace App\Service\Database;

use App\Models\Activity;
use App\Models\School;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

class ActivityService{

    public function index($schoolId,  $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $name = $filter['name'] ?? null;
        $topicId = $filter['topic_id'] ?? null;
        $status = $filter['status'] ?? null;
        $type = $filter['type'] ?? null;

        School::findOrFail($schoolId);

        $query = Activity::orderBy('created_at', $orderBy);

        if ($name !== null) {
            $query->where('name', $name);
        }

        if ($status !== null) {
            $query->where('status', $status);
        }

        if ($type !== null) {
            $query->where('type', $type);
        }

        if ($topicId !== null) {
            $query->where('topic_id', $topicId);
        }

        $activities = $query->simplePaginate($per_page);

        return $activities->toArray();
    }

    public function detail($schoolId, $activityId)
    {
        School::findOrFail($schoolId);
        $activity = Activity::findOrFail($activityId);

        return $activity->toArray();
    }

    public function create($schoolId, $topicId, $payload)
    {
        School::findOrFail($schoolId);
        Topic::findOrFail($topicId);

        $activity = new Activity;
        $activity->id = Uuid::uuid4()->toString();
        $activity->topic_id = $topicId;
        $activity = $this->fill($activity, $payload);
        $activity->save();

        return $activity->toArray();
    }

    public function update($schoolId, $topicId, $activityId, $payload)
    {
        School::findOrFail($schoolId);
        Topic::findOrFail($topicId);

        $activity = Activity::findOrFail($activityId);
        $activity = $this->fill($activity, $payload);
        $activity->save();

        return $activity->toArray();
    }

    private function fill(Activity $activity, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $activity->$key = $value;
        }

        Validator::make($activity->toArray(), [
            'topic_id' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'time' => 'nullable|numeric',
            'estimation' => 'nullable|numeric',
            'status' => ['required', Rule::in(config('constant.activity.status'))],
            'type' => ['required', Rule::in(config('constant.activity.type'))],
        ])->validate();

        return $activity;
    }
}
