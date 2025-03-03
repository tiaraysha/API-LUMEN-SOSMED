<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository { // nama ini HARUS SAMA KAYA NAMA FILE
    public function regis(array $data) {
        return User::create($data);
    }

    public function getAllUser() {
        // mengambil semua data dengan pagination
        return User::paginate(10);
    }


    public function getSpecificUser($id) {
        return User::find($id);
    }

    public function updateUser($id, array $data) {
        //update dlu datanya
        User::where('id', $id)->update($data);
        //yg dikembalikan hasil pencarian dr data yg baru diupdate tsb
        return User::find($id);
    }

    public function deleteUser($id) {
        return User::destroy($id);
    }
}

?>