<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;

class PostController extends Controller
{
    private $PostService;

    public function __construct(PostService $PostService)
    {
        $this->PostService = $PostService;
        // $this->stuffStockService = $stuffStockService;
    }

    public function index() 
    {
        try {

            $post = $this->PostService->index();
            return response()->json(PostResource::collection($post), 200);
        } catch (\Execption $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function show($id) {
        try {
            $Post = $this->PostService->show($id);
            return response()->json(new PostResource($Post), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function store(Request $request) {
        try  {
            $payload = PostRequest::validate($request);
            // yg dikirim $request bukan $payload karna ingin mengirim request file nya
            $Post = $this->PostService->store($request);
            return response()->json(new PostResource($Post), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }

    public function update(Request $request, $id) {
        try {
            $payload = PostRequest::validate($request);
            $Post = $this->PostService->update($id, $payload);
            return response()->json(new PostResource($Post), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
        }
    }
    
    
    public function delete($id)
    {
        try {
            $Post = $this->PostService->delete($id);
            return response()->json(new PostResource($Post), 200);
        } catch (\Exception $err) {
            return response()->json($err->getMessage(), 400);
    }
    }
}
