<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PostRepository {

    public function getAllPost() {
        return Post::paginate(10);
    }

    public function getPostById($id) {
        return Post::find($id);
    }

    public function uploadImage($file)
    {
        // membuat nama file unik dengan Str::random()
        // karakteracak_namafilebawaan.extensi : pake random biar ngasi nama unik antar file
        $imageName = Str::random(5) . "_" . $file->getClientOriginalName();

        // upload file ke direktori storage
        $storageDirectory = storage_path('app/public/images');

        // cek jika directory belum ada, maka buat dulu
        if(!File::exists($storageDirectory)) {
            // 0755 : mengatur hak akses pengguna, agar file bisa di lihat public namun tdk dimodifikasi oleh public kecuali owner
            File::makeDirectory($storageDirectory, 0755, true);
        }
        
        // proses memindahkan gambar yg diupload ke storage, ke folder maan, namanya apa
        $file->move($storageDirectory, $imageName);
        
        // membuat symlink antara folder storage dengan public, agar gambar bisa dimunculkan melalui url
        $publicDirectory =  base_path('public/storage');
        if (!File::exists($publicDirectory)) {
            File::link(storage_path('app/public'), $publicDirectory);
        }
        // link untuk menampilkan gambar nantinya
        $imageLink = env('APP_URL') . 'storage/images/' . $imageName;
        return $imageLink;
    }

    public function updatePost($id, array $data) {
        //update dlu datanya
        Post::where('id', $id)->update($data);
        //yg dikembalikan hasil pencarian dr data yg baru diupdate tsb
        return Post::find($id);
    }

    public function storeNewPost(array $data) {
        $post = Post::create($data); 

        User::where('id', Auth::user()->id)->increment('total_post');

        return $post;
    }

    public function deletePost($id) {
        // return Post::delete($id);
        $Post = Post::find($id);

        $imagePath = storage_path('app/public/images/' . basename($Post->image));
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $Post->delete();

        return $Post;
    }

}
