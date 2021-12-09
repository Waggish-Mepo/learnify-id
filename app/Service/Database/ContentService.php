<?php

namespace App\Service\Database;

use App\Models\Content;
use App\Models\School;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

class ContentService{

    public function index($schoolId,  $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $name = $filter['name'] ?? null;
        $topicId = $filter['topic_id'] ?? null;
        $status = $filter['status'] ?? null;

        School::findOrFail($schoolId);

        $query = Content::orderBy('created_at', $orderBy);

        if ($name !== null) {
            $query->where('name', $name);
        }

        if ($status !== null) {
            $query->where('status', $status);
        }

        if ($topicId !== null) {
            $query->where('topic_id', $topicId);
        }

        $contents = $query->simplePaginate($per_page);

        return $contents->toArray();
    }

    public function detail($schoolId, $contentId)
    {
        School::findOrFail($schoolId);
        $content = Content::findOrFail($contentId);

        return $content->toArray();
    }

    public function create($schoolId, $topicId, $payload)
    {
        School::findOrFail($schoolId);
        Topic::findOrFail($topicId);

        $content = new Content;
        $content->id = Uuid::uuid4()->toString();
        $content->topic_id = $topicId;
        $content = $this->fill($content, $payload);
        $content->save();

        return $content->toArray();
    }

    public function update($schoolId, $topicId, $contentId, $payload)
    {
        School::findOrFail($schoolId);
        Topic::findOrFail($topicId);

        $content = Content::findOrFail($contentId);
        $content = $this->fill($content, $payload);
        $content->save();

        return $content->toArray();
    }

    private function fill(Content $content, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $content->$key = $value;
        }

        Validator::make($content->toArray(), [
            'topic_id' => 'required|string',
            'name' => 'required|string',
            'content' => 'nullable|string',
            'experience' => 'nullable|numeric',
            'estimation' => 'nullable|numeric',
            'status' => ['required', Rule::in(config('constant.content.status'))],
        ])->validate();

        return $content;
    }
}
