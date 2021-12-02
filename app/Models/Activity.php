<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    public $incrementing = false;

    const EXERCISE = 'EXERCISE';
    const EXAM = 'EXAM';

    const PUBLISHED = 'PUBLISHED';
    const DRAFT = 'DRAFT';
}
