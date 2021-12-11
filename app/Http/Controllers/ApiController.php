<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getMsg(Request $request)
    {
        
        $data = DB::table('notif')->where('student_id',$request->user_id)->get();  
        return response()->json(['data'=>$data], 200);   
    }

    public function updateMsg(Request $request)
    {
        DB::table('notif')->where('id',$request->id)->update([
            'is_send'=>1
        ]);
        return response()->json(['data'=>'beres'], 200);
    }
}
