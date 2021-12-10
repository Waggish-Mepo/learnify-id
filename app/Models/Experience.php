<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    const REQUIRED_XP = 100;

    public $incrementing = false;

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
