<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('upload');
        $input['imagename'] = time() . rand() . '.' . $image->extension();
        if (!file_exists(public_path('/assets/images/teacher-upload/' . $image->getClientOriginalName()))) {
            $destinationPath = public_path('/assets/images/teacher-upload/');
            if ($image->move($destinationPath, $input['imagename'])) {
                return response()->json([
                    'url' => asset("/assets/images/teacher-upload/". $input['imagename'])
                ]);
            }
        }
    }

}
