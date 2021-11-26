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
        'school_id',
        'name',
        'username',
        'password',
        'role',
        'status',
        'email',
        'nis',
        'created_at',
        'update_at',
    ];
}
