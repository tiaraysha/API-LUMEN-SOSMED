<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

use App\Models\User;

class UserRequest
{
    public static function validate(Request $request)
    {

        $rules = [
            'username' => 'required|min:5',
            'password' => 'required',
        ];

        $validator = app(Factory::class)->make($request->all(), $rules);
        if($validator->fails()) {
            response()->json($validator->errors(), 400)->send();
            exit;
        } else {
            return $validator->validated();
        }
    }
}

?>