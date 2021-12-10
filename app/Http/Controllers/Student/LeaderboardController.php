<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Service\Database\ExperienceService;
use App\Service\Database\SchoolService;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $experience = Auth::user()->experience;
        $experienceService = new ExperienceService;
        $schoolService = new SchoolService;

        $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;

        $filter = [
            'grade' => $user->grade,
            'with_users' => true,
            'order_by_xp' => true,
        ];

        $users = $experienceService->index($user->school_id, $filter)['data'];
        $schoolDetail = $schoolService->detail($user->school_id);
        $rankOrder = 1;
        $currentUserRank = 0;
        $students = [];
        foreach($users as $student) {
            if ($student['user_id'] === $user->id) {
                $currentUserRank = $rankOrder;
            }
            $student['rank_order'] = $rankOrder;
            $rankOrder++;
            $students[] = $student;
        }

        return view('student.leaderboard.index')
            ->with('user', $user)
            ->with('schoolDetail', $schoolDetail)
            ->with('currentUserRank', $currentUserRank)
            ->with('students', $students)
            ->with('experience', $experience);
    }
}
