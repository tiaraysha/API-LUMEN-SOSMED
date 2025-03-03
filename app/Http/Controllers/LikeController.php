<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Repositories\LikeRepository;

class LikeController extends Controller {
    private $likeRepository;

    public function __construct(LikeRepository $likeRepository) {
        $this->likeRepository = $likeRepository;
    }

    public function likeUnlike($postId) {
        try {
            $result = $this->likeRepository->likeUnlike($postId);
            return response()->json(['message' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}