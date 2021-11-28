<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Database\UserService;
use Illuminate\Support\Facades\Auth;

class ManageAccountController extends Controller
{
    public function getAccount(Request $request)
    {
        $userDB = new UserService;

        $schoolId = Auth::user()->school_id;
        
        $accounts = $userDB->index($schoolId, ['role' => $request->role]);

        return response()->json($accounts);
    }

    public function createAccount(Request $request)
    {
        $userDB = new UserService;
        $schoolId = Auth::user()->school_id;
        
        $payload = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->username,
            'role' => $request->role,
            'email' => $request->email,
            'status' => 1,
        ];
        
        if ($request->role === 'STUDENT') {
            $payload['nis'] = $request->nis;
        }
        
        $create = $userDB->create($schoolId, $payload);
        
        return response()->json($create);
    }
}
