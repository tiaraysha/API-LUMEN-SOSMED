<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class UserService {
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() {
        return $this->userRepository->getAllUser();
    }

    public function store(array $data) 
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->regis($data);
    }

    public function show($id) {
        return $this->userRepository->getSpecificUser($id);
    }

    public function update($id, array $data) {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->updateUser($id, $data);
    }

    public function login(array $data)
    {
        $token = Auth::attempt($data);
        if (!$token) {
            // jika login gagal, langsung beri response dan hentikan proses apapun setelahnya
            return response()->json('Login gagal, silahkan cek username dan password anda!', 400)->send();
            exit;
        }
        $responseToken = [
            'access_token' => $token, //token jwt
            "token_type" => "bearer", //tipe token default dr JWT
            "user" => Auth::user(), //detail data pengguna
        ];
        return $responseToken;
    }

    public function destroy($id) {
        return $this->userRepository->deleteUser($id);
    }

    public function me() {
        return Auth::user();
    }

    public function logout() {
        Auth::logout();
    }
}
?>