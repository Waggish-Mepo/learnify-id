<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Database\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard() {
        //inisialisasi dulu service nya
        $userService = new UserService;

        //ini kalo auth nya udah work cara ngambil school id nya begini
        // $schoolId = Auth::user()->school_id;
        // $userId = Auth::user()->id;

        //ini buat filter, bisa role atau name cek di class UserService nya
        $filter = [
            'role' => 'ADMIN',
            'per_page' => 20,
            'order_by' => 'ASC'
        ];

        //$schoolId selalu dibutuhin buat request
        /*
        contoh ambil index:
        $users = $userService->index('a68dcc36-b5ca-3b1d-b6cd-2adacc1121eb', $filter);

        contoh ambil detail:
        $userDetail = $userService->detail($schoolId, $userId);
        */

        // dd($userDetail);
    }
}
