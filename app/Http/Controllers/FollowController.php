<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FollowRepository;

class FollowController extends Controller
{
    public function __construct(FollowRepository $followRepository) {
        $this->followRepository = $followRepository;
    }

    public function followUnfollow($id) {
        try {
            $follow =  $this->followRepository->followUnfollow($id);
        return response()->json(['message' => $follow], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
    }
    }
}