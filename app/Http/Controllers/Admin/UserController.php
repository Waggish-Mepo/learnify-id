<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Database\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard() {
        $userService = new UserService;

        $schoolId = Auth::user()->school_id;
        $userId = Auth::user()->id;

        $user = $userService->detail($schoolId, $userId);

        // Admin Dashboard
        if ($user['role'] === 'ADMIN') {
            $users = $userService->index($schoolId)['data'];
            return view('admin.dashboard', compact('users'));
        }

        // Teacher Dashboard
        if ($user['role'] === 'TEACHER') {
            return view('teacher.dashboard')
            ->with('user', $user);
        }

        // Student Dashboard
        if ($user['role'] === 'STUDENT') {
            // 
            return view('student.dashboard');
        }
    }
}
