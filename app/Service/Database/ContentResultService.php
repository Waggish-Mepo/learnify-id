<?php

namespace App\Service\Database;

use App\Models\Content;
use App\Models\ContentResult;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ContentResultService{
    public function index($schoolId,  $filter = []) {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $content_id = $filter['content_id'] ?? null;
        $student_id = $filter['student_id'] ?? null;

        School::findOrFail($schoolId);

        $query = ContentResult::orderBy('created_at', $orderBy);

        if ($content_id !== null) {
            $query->where('content_id', $content_id);
        }

        if ($student_id !== null) {
            $query->where('student_id', $student_id);
        }

        $contentResults = $query->simplePaginate($per_page);

        return $contentResults->toArray();
    }

    public function detail($schoolId, $contentResultId)
    {
        School::findOrFail($schoolId);
        $contentResult = ContentResult::findOrFail($contentResultId);

        return $contentResult->toArray();
    }

    public function create($schoolId, $contentId, $studentId, $payload)
    {
        School::findOrFail($schoolId);
        Content::findOrFail($contentId);
        User::findOrFail($studentId);

        $contentResult = new ContentResult;
        $contentResult->id = Uuid::uuid4()->toString();
        $contentResult->content_id = $contentId;
        $contentResult->student_id = $studentId;
        $contentResult = $this->fill($contentResult, $payload);
        $contentResult->save();

        return $contentResult->toArray();
    }

    public function update(
        $schoolId,
        $contentId,
        $studentId,
        $contentResultId,
        $payload
    )
    {
        School::findOrFail($schoolId);
        Content::findOrFail($contentId);
        User::findOrFail($studentId);

        $contentResult = ContentResult::findOrFail($contentResultId);
        $contentResult = $this->fill($contentResult, $payload);
        $contentResult->save();

        return $contentResult->toArray();
    }

    private function fill(ContentResult $contentResult, array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $contentResult->$key = $value;
        }

        Validator::make($contentResult->toArray(), [
            'status' => 'required|integer',
        ])->validate();

        return $contentResult;
    }
}
