<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Validation\Factory;
use Illuminate\Http\Request;

class PostRequest {

    public static function validate(Request $request)
    {
        $request['image'] = $request->image ?? NULL;
        $rules = [
            'content' => 'required|min:3',
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