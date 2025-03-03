<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

class CommentRequest 
{
    public static function validate(Request $request) {
        
        $rules = [
            'comment' => 'required',
            'post_id' => 'required',
            'user_id' => 'required',
        ];

        $validator = app(Factory::class)->make($request->all(), $rules);

        if ($validator->fails()) {
            response()->json($validator->errors(), 400)->send();
            exit;
        } else {
            return $validator->validated();
        }
    }
}