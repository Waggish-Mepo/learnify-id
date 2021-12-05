<?php

namespace App\Service\Database;

use App\Models\Experience;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ExperienceService
{
    public function index($schoolId,  $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 20;
        $user_id = $filter['student_id'] ?? null;

        School::findOrFail($schoolId);

        $query = Experience::orderBy('created_at', $orderBy);

        if ($user_id !== null) {
            $query->where('user_id', $user_id);
        }

        $experiences = $query->simplePaginate($per_page);

        return $experiences->toArray();
    }

    public function detail($schoolId, $experienceId)
    {
        School::findOrFail($schoolId);
        $experience = Experience::findOrFail($experienceId);

        return $experience->toArray();
    }

    public function create($schoolId,$userId, $payload)
    {
        School::findOrFail($schoolId);
        User::findOrFail($userId);

        $experience = new Experience;
        $experience->id = Uuid::uuid4()->toString();
        $experience->user_id = $userId;
        $experience = $this->fill($experience, $payload);
        $experience->save();

        return $experience->toArray();
    }

    public function update($schoolId, $userId, $experienceId, $payload)
    {
        School::findOrFail($schoolId);
        User::findOrFail($userId);

        $experience = Experience::findOrFail($experienceId);
        $experience = $this->fill($experience, $payload);
        $experience->save();

        return $experience->toArray();
    }

    private function fill(Experience $experience, array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $experience->$key = $value;
        }

        Validator::make($experience->toArray(), [
            'user_id' => 'required',
            'experience_point' => 'required|integer',
            'level' => 'required|integer',
        ])->validate();

        return $experience;
    }
}
