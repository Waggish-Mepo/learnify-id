<?php

namespace App\Service\Database;

use App\Models\Course;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class CourseService{

    public function index($schoolId, $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $grade = $filter['grade'] ?? null;
        $byGrade = $filter['by_grade'] ?? null;
        $subjectId = $filter['subject_id'] ?? null;
        $createdBy = $filter['created_by'] ?? null;

        School::findOrFail($schoolId);

        $query = Course::orderBy('created_at', $orderBy);
        if ($byGrade === 1) {
            $query = Course::orderBy('grade', 'asc');
        }

        if ($grade !== null) {
            $query->where('grade', $grade);
        }

        if ($subjectId !== null) {
            $query->where('subject_id', $subjectId);
        }

        if ($createdBy !== null) {
            $query->where('created_by', $createdBy);
        }

        $courses = $query->simplePaginate($per_page);

        return $courses->toArray();
    }

    public function detail($schoolId, $courseId)
    {
        School::findOrFail($schoolId);
        $course = Course::findOrFail($courseId);

        return $course->toArray();
    }

    public function create($schoolId, $subjectId, $payload)
    {
        School::findOrFail($schoolId);
        Subject::findOrFail($subjectId);

        $course = new Course;
        $course->id = Uuid::uuid4()->toString();
        $course->subject_id = $subjectId;
        $course = $this->fill($course, $payload);
        $course->save();

        return $course->toArray();
    }

    public function update($schoolId, $subjectId, $courseId, $payload)
    {
        School::findOrFail($schoolId);
        Subject::findOrFail($subjectId);

        $course = Course::findOrFail($subjectId);
        $course = $this->fill($course, $payload);
        $course->save();

        return $course->toArray();
    }

    private function fill(Course $course, array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $course->$key = $value;
        }

        Validator::make($course->toArray(), [
            'description' => 'required|string',
            'subject_id' => 'required|string',
            'created_by' => 'required|string',
        ])->validate();

        return $course;
    }
}
