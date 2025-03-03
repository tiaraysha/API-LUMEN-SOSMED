<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


// resources: mengatur response data yg akan dihasilkan dari API ini

class PostResource extends JsonResource {

    public function toArray($request) {
        // $this->post ? $this->post->makeHidden('postStock') : $this->post;
        return [
            "id" => $this->id,  
            "post" => $this->content, 
            "date_time" => $this->date_time,
            "image" => $this->image, 
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
        ];
    }
}

?>