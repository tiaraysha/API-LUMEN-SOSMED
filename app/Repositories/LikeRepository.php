<?php

namespace App\Repositories;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeRepository {
    public function likeUnlike($postId) {
        $user = auth()->user();

        // Cek apakah like sudah ada termasuk yang sudah soft deleted
        $like = Like::withTrashed()->where('post_id', $postId)->where('user_id', $user->id)->first();

        if ($like) {
            if ($like->trashed()) {
                // law udh di like trus di unlik ini di restore
                $like->restore();
                Post::where('id', $postId)->increment('likes');
                return 'Berhasil menyukai postingan!';
            } else {
                // ini law udh di like trus di unlike
                $like->delete();
                Post::where('id', $postId)->decrement('likes');
                return 'Batal menyukai';
            }
        } else {
            // law belum pernah like
            Like::create([
                'post_id' => $postId,
                'user_id' => $user->id
            ]);
            Post::where('id', $postId)->increment('likes');
            return 'Berhasil menyukai postingan!';
        }
    }
}
