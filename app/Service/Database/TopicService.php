<?php

namespace App\Service\Database;

use App\Models\Course;
use App\Models\School;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class TopicService{

    public function index($schoolId, $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 20;
        $subjectId = $filter['subject_id'] ?? null;
        $courseId = $filter['course_id'] ?? null;

        School::findOrFail($schoolId);

        $query = Topic::orderBy('order', $orderBy);

        if ($subjectId !== null) {
            $query->where('subject_id', $subjectId);
        }

        if ($courseId !== null) {
            $query->where('course_id', $courseId);
        }

        $topics = $query->simplePaginate($per_page);

        return $topics->toArray();
    }

    public function detail($schoolId, $topicId)
    {
        School::findOrFail($schoolId);
        $subject = Topic::findOrFail($topicId);

        return $subject->toArray();
    }

    public function create($schoolId, $subjectId, $courseId, $payload)
    {
        School::findOrFail($schoolId);
        Subject::findOrFail($subjectId);
        Course::findOrFail($courseId);

        $topic = new Topic;
        $topic->id = Uuid::uuid4()->toString();
        $topic->subject_id = $subjectId;
        $topic->course_id = $courseId;
        $topic = $this->fill($topic, $payload);
        $topic->save();

        return $topic->toArray();
    }

    public function update($schoolId, $subjectId, $courseId, $topicId, $payload)
    {
        School::findOrFail($schoolId);
        Subject::findOrFail($subjectId);
        Course::findOrFail($courseId);

        $topic = Topic::findOrFail($topicId);
        $topic = $this->fill($topic, $payload);
        $topic->save();

        return $topic->toArray();
    }

    private function fill(Topic $course, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $course->$key = $value;
        }

        Validator::make($course->toArray(), [
            'name' => 'nullable|string',
            'subject_id' => 'required|string',
            'course_id' => 'required|string',
            'order' => 'required|numeric',
        ])->validate();

        return $course;
    }
}
