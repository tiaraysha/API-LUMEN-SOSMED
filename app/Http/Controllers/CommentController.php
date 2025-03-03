<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\CommentService;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService) {
        $this->commentService = $commentService;
    }

    public function index() {
        try {
            $comment = $this->commentService->index();
            return response()->json(CommentResource::collection($comment), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function store(Request $request) {
        try {
            $payload = $this->validate($request, [
                'comment' => 'required',
                'user_id' => 'required',
                'post_id' => 'required',
            ]);
            
            $comment = $this->commentService->store($payload);
            return response()->json(new CommentResource($comment), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function update(Request $request, $id) {
        try {
            $payload = CommentRequest::validate($request);
            $Comment = $this->commentService->update($id, $payload);
            return response()->json(new CommentResource($Comment), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function delete($id) {
        try {
            $deleted = $this->commentService->delete($id);
    
            if ($deleted) {
                return response()->json(['message' => 'Berhasil menghapus komentar!'], 200);
            }
    
            return response()->json(['message' => 'Komentar tidak ditemukan'], 404);
        } catch (\Exception $err) {
            return response()->json(['error' => $err->getMessage()], 400);
        }
    }
    
    
}
