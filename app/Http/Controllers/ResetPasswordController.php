<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function edit(){
        return view('shared.reset_password');
    }

    public function update(Request $request){
        request()->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        $currentPassword = auth()->user()->password;
        $old_password = request('old_password');

        if(HASH::check($old_password, $currentPassword)){
            auth()->user()->update([
                'password' => bcrypt(request('password')),
            ]);
        }
        else{
            return back()->with('error', 'Anda harus mengisi password lama Anda');
        }
    }
}
