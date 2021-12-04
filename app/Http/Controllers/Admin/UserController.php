<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Database\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function dashboard() {
        $userService = new UserService;

        $schoolId = Auth::user()->school_id;
        $userId = Auth::user()->id;

        $user = $userService->detail($schoolId, $userId);

        $pw_matches = Session::get('pw_matches') ?? 0;

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
            // 
            return view('student.dashboard', compact('pw_matches'));
        }
    }
}
