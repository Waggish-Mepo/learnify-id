<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ADMIN = 'ADMIN';
    const STUDENT = 'STUDENT';
    const TEACHER = 'TEACHER';

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
        'grade',
        'created_at',
        'update_at',
    ];

    public function experience(){
        return $this->hasOne(Experience::class);
    }
}
