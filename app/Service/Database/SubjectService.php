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
        $relation = $filter['with_subject_teacher'] ?? false;

        School::findOrFail($schoolId);

        $query = Subject::orderBy('created_at', $orderBy);

        $query->where('school_id', $schoolId);

        if ($name !== null) {
            $query->where('name', $name);
        }

        if ($relation) {
            $query->with('subjectTeacher');
        }

        $subjects = $query->simplePaginate($per_page);

        return $subjects->toArray();
    }

    public function detail($schoolId, $subjectId)
    {
        School::findOrFail($schoolId);
        $subject = Subject::findOrFail($subjectId);

        return $subject->toArray();
    }

    public function create($schoolId, $payload)
    {
        School::findOrFail($schoolId);

        $subject = new Subject;
        $subject->id = Uuid::uuid4()->toString();
        $subject->school_id = $schoolId;
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject->toArray();
    }

    public function update($schoolId, $subjectId, $payload)
    {
        School::findOrFail($schoolId);
        $subject = Subject::findOrFail($subjectId);
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject->toArray();
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
