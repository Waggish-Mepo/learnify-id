<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function check(Request $request){
        if (! Auth::check() && $request->is('login')) {
            return view('shared.login');
        } elseif (! Auth::check()) {
            return redirect('login');
        }

        return redirect('dashboard');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(($credentials + ['status' => true]), $request->get('remember'))){
            $currentPassword = auth()->user()->password;

            if (HASH::check(Auth::user()->username, $currentPassword)){
                $pw_matches = true;
                return redirect('dashboard')->with('pw_matches', $pw_matches);
            }

            return redirect('dashboard');
        }

        return redirect('login');
    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }
}
