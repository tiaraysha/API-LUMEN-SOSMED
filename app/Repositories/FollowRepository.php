<?php

namespace App\Repositories;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowRepository {
    public function followUnfollow($id) {
        $user = Auth::user(); //ini user yg mw follow
        $targetUser = User::find($id); //ini user yg di follow

        $follow = Follow::withTrashed()->where('follower_id', $user->id)->where('following_id', $id)->first();

        if ($follow) {
            if ($follow->trashed()) {
                // law udh di follow trus di unlik ini misal mw like lg
                $follow->restore();
                $targetUser->increment('followers'); 
                $user->increment('following'); 
                return 'Berhasil mengikuti!';
            } else {
                // ini law udh di follow trus di unfollow
                $follow->delete();
                if ($targetUser->followers > 0) {
                    $targetUser->decrement('followers');
                }
                if ($user->following > 0) {
                    $user->decrement('following');
                }
                return 'Batal mengikuti!';
            }
        } else {
            // law belum pernah follow
            Follow::create([
                'follower_id' => $user->id,
                'following_id' => $id
            ]);
            $targetUser->increment('followers'); 
            $user->increment('following'); 
            return "Berhasil mengikuti!";
        }
    }
}