<?php

namespace App\Service\Database;

use App\Models\School;
use App\Models\Subject;
use App\Models\SubjectTeacher;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class SubjectTeacherService {
    public function index($schoolId, $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $teacherId = $filter['teacher_id'] ?? null;

        School::findOrFail($schoolId);

        $query = SubjectTeacher::orderBy('created_at', $orderBy);
        
        if ($teacherId !== null) {
            $query->whereJsonContains('teachers', $teacherId);
        }

        $users = $query->simplePaginate($per_page);

        return $users;
    }

    public function detail($schoolId, $subjectTeacherId)
    {
        School::findOrFail($schoolId);
        $subject = SubjectTeacher::findOrFail($subjectTeacherId);

        return $subject;
    }

    public function create($schoolId, $payload)
    {
        School::findOrFail($schoolId);

        $subject = new SubjectTeacher();
        $subject->id = Uuid::uuid4()->toString();
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject;
    }

    public function update($schoolId, $subjectTeacherId, $payload)
    {
        School::findOrFail($schoolId);
        $subject = SubjectTeacher::findOrFail($subjectTeacherId);
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject;
    }

    private function fill(SubjectTeacher $subject, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $subject->$key = $value;
        }

        Validator::make($subject->toArray(), [
            'subject_id' => 'required|string',
            'teachers' => 'nullable|array',
        ])->validate();

        return $subject;
    }
}
