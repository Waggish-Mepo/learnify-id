<?php

namespace App\Service\Database;

use App\Models\School;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class SubjectService{

    public function index($schoolId, $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 20;
        $name = $filter['name'] ?? null;

        School::findOrFail($schoolId);

        $query = Subject::orderBy('created_at', $orderBy);

        $query->where('school_id', $schoolId);

        if ($name!== null) {
            $query->where('name', $name);
        }

        $users = $query->simplePaginate($per_page);

        return $users;
    }

    public function detail($schoolId, $subjectId)
    {
        School::findOrFail($schoolId);
        $subject = Subject::findOrFail($subjectId);

        return $subject;
    }

    public function create($schoolId, $payload)
    {
        School::findOrFail($schoolId);

        $subject = new Subject;
        $subject->id = Uuid::uuid4()->toString();
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject;
    }

    public function update($schoolId, $subjectId, $payload)
    {
        School::findOrFail($schoolId);
        $subject = Subject::findOrFail($subjectId);
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject;
    }

    private function fill(Subject $subject, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $subject->$key = $value;
        }

        Validator::make($subject->toArray(), [
            'name' => 'required|string',
        ])->validate();

        return $subject;
    }
}
