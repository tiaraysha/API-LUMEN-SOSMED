<?php

namespace App\Services;

use App\Repositories\CommentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index() {
        return $this->commentRepository->getAllComment();
    }

    public function store($data) {
        $comments = [
            'date_time' => Carbon::now(),
            'comment' => $data['comment'], // Akses sebagai array
            "user_id" => Auth::id(), // Ambil langsung dari Auth
            "post_id" => $data['post_id']
        ];
        
        return $this->commentRepository->newComment($comments); // Pastikan return model, bukan ID
    }
    

    public function update($id, $data) {
        return $this->commentRepository->updateComment($id, $data);
    }

    public function delete($id) {
        return $this->commentRepository->deleteComment($id);
    }
}