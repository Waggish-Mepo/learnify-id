<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Service\Database\ExperienceService;
use App\Service\Database\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
Use \Carbon\Carbon;

class UserController extends Controller
{
    public function dashboard() {
        $userService = new UserService;
        $experienceDB = new ExperienceService;

        $schoolId = Auth::user()->school_id;
        $userId = Auth::user()->id;

        $user = $userService->detail($schoolId, $userId);

        $pw_matches = Session::get('pw_matches') ?? 0;

        $time = date('H:i:a', time());

        // Admin Dashboard
        if ($user['role'] === 'ADMIN') {
            $users = $userService->index($schoolId)['data'];
            return view('admin.dashboard', compact('users', 'pw_matches'));
        }

        // Teacher Dashboard
        if ($user['role'] === 'TEACHER') {
            return view('teacher.dashboard', compact('pw_matches'))
            ->with('user', $user);
        }

        // Student Dashboard
        if ($user['role'] === 'STUDENT') {
            $experience = Auth::user()->experience;

            if ($experience === null) {
                $experienceDB->create($schoolId, $userId, ['grade' => Auth::user()->grade ?? null, 'experience_point' => 0, 'level' => 0]);
                $experience = Auth::user()->experience;
            }

            $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;
            return view('student.dashboard', compact('pw_matches', 'user', 'experience'));
        }
    }
}
