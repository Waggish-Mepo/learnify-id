<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function check(){
        if (! Auth::check()) {
            return redirect('login');
        }

        return redirect('home');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(($credentials + ['status' => true]))){
            return redirect('home');
        }

        return redirect('login');
    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }
}
