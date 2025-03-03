<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Post;

class CommentRepository {

    public function getAllComment() {
        return Comment::paginate(10);
    }

    public function newComment(array $data) {
        $comment =  Comment::create($data);

        Post::where('id', $data['post_id'])->increment('comments');

        return $comment;
    }

    public function updateComment($id, array $data) {
        //update dlu datanya
        Comment::where('id', $id)->update($data);
        //yg dikembalikan hasil pencarian dr data yg baru diupdate tsb
        return Comment::find($id);
    }

    public function deleteComment($id) {
        $comment = Comment::withTrashed()->find($id); // Gunakan withTrashed()
    
        if (!$comment || $comment->trashed()) {
            return false; // Kembalikan false kalau comment tidak ditemukan
        }
    
        // Kurangi jumlah komentar di tabel posts
        Post::where('id', $comment->post_id)->decrement('comments'); 
    
        // Hapus komentar secara soft delete
        $comment->delete();
    
        return true; // Pastikan return true jika sukses
    }
    
    
}