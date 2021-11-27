<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'school_id',
        'created_at',
        'update_at',
    ];

    public function subjectTeacher() {
        return $this->hasOne(SubjectTeacher::class, 'subject_id', 'id');
    }
}
