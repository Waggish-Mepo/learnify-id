<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentResult extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'content_result';
}
