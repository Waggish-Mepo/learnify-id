<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'subject_id',
        'teachers',
        'created_at',
        'update_at',
    ];

    protected $casts = [
        'teachers' => 'array',
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
