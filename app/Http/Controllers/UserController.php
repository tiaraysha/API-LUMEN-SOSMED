<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    //
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index() 
    {
        try {

            $posts = $this->userService->index();
            // response()->json : hasil yg akan dimunculkan ketika mengakses url terkait : json (data yg mw di munculin, httpstatuscode)
            return response()->json(UserResource::collection($posts), 200);
        } catch (\Execption $err) {
            // jika try ada yg error, munculkan response berupa desk err dan statusnya 400
            return response()->json($err->getMessage(), 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $payload = UserRequest::validate($request);
            $user = $this->userService->store($payload);
            // jika mengambil data gunakan :: collection, jika menambah/mengubah data gunakan new
            return response()->json(new UserResource($user), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function login(Request $request)
    {
        try {
            $payload = LoginRequest::validate($request);
            $login = $this->userService->login($payload);
            return response()->json($login, 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function profile() 
    {
        try {
            $users = $this->userService->me();
            // response()->json : hasil yg akan dimunculkan ketika mengakses url terkait : json (data yg mw di munculin, httpstatuscode)
            return response()->json(new UserResource($users), 200);
        } catch (\Execption $err) {
            // jika try ada yg error, munculkan response berupa desk err dan statusnya 400
            return response()->json($err->getMessage(), 400);
        }
    }

    public function show($id)
    {
        try {
            $stuff = $this->userService->show($id);
            // jika mengambil data gunakan :: collection, jika menambah/mengubah data gunakan new
            return response()->json(new UserResource($stuff), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $payload = UserRequest::validate($request);
            $account = $this->userService->update($id, $payload);
            // jika mengambil data gunakan :: collection, jika menambah/mengubah data gunakan new
            return response()->json(new UserResource($account), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function delete($id)
    {
        try {
            $users = $this->userService->destroy($id);
            // return response()->json(new userResource($user), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function logout() 
    {
        try {
            $users = $this->userService->logout();
            return response()->json('Berhasil logout!', 200);
        } catch (\Execption $err) {
            // jika try ada yg error, munculkan response berupa desk err dan statusnya 400
            return response()->json($err->getMessage(), 400);
        }
    }
}
