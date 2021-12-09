<?php

namespace App\Service\Database;

use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Ramsey\Uuid\Uuid;

class UserService {

    public function index($schoolId, $filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 999;
        $role = $filter['role'] ?? null;
        $name = $filter['name'] ?? null;
        $grade = $filter['grade'] ?? null;
        $with_experience = $filter['with_experience'] ?? null;

        School::findOrFail($schoolId);

        $query = User::orderBy('created_at', $orderBy);

        $query->where('school_id', $schoolId);

        if ($role !== null) {
            $query->where('role', $role);
        }

        if ($name !== null) {
            $query->where('name', $name);
        }

        if ($grade !== null) {
            $query->where('grade', $grade);
        }

        if ($with_experience) {
            $query->with('experience');
        }

        $users = $query->simplePaginate($per_page);

        return $users->toArray();
    }

    public function detail($schoolId, $userId)
    {
        School::findOrFail($schoolId);
        $user = User::findOrFail($userId);

        return $user->toArray();
    }

    public function bulkDetail($schoolId, $userIds){
        $query = User::where('school_id', $schoolId)->whereIn('id', $userIds);

        $users = $query->simplePaginate(20);

        return $users->toArray();
    }

    public function create($schoolId, $payload)
    {
        School::findOrFail($schoolId);

        $user = new User;
        $user->id = Uuid::uuid4()->toString();
        $user->school_id = $schoolId;
        $user = $this->fill($user, $payload);
        $user->password = Hash::make($user->password);
        $user->save();

        return $user;
    }

    public function update($schoolId, $userId, $payload)
    {
        School::findOrFail($schoolId);
        $user = User::findOrFail($userId);
        $user = $this->fill($user, $payload);
        $user->password = Hash::make($user->password);
        $user->save();

        return $user;
    }

    private function fill(User $user, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $user->$key = $value;
        }

        Validator::make($user->toArray(), [
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            'status' => 'required',
            'nis' => 'nullable|numeric',
            'grade' => 'nullable|numeric',
            'email' => 'nullable|email',
            'role' => ['required', Rule::in(config('constant.user.roles'))],
        ])->validate();

        return $user;
    }
}
