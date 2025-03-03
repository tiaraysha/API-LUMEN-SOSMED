<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource{
    
    public function toArray($request) {
        return [
            "id" => $this->id,
            "comment" => $this->comment,
            "post_id" => $this->post_id,
            "user_id" => $this->user_id
        ];
    }
}
