<?php

namespace App\Services;

use App\Repositories\PostRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostService {
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index() {
        return $this->postRepository->getAllPost();
    }

    public function show($id) {
        return $this->postRepository->getPostById($id);
    }

    // parameter $data bukan array $data karna nanti akan menerima object Request dari controller
    public function store($data)
    {
        // jika terdaapt file pada payload proof_file
        $imageLink = NULL;
        if($data->file('image')) {
            $imageLink = $this->postRepository->uploadImage($data->file('image'));
        }
        // buat format array yg akan dikirim ke db
        $Post = [
            'date_time' => Carbon::now(),
            'image' => $imageLink,
            'content' => $data->content,
            "user_id" => Auth::user()->id,
        ];
        $store = $this->postRepository->storeNewPost($Post);
        return $store;
    }

    public function update($id, array $data) {
        return $this->postRepository->updatePost($id, $data);
    }
    
    public function delete($id)
    {
        return $this->postRepository->deletePost($id);
    }

}
