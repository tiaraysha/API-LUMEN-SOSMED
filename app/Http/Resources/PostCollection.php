<?php

namespace App\Http\Resources;

// collection : format dari resources nya

class PostCollection extends ResourceCollection 
{
    public function toArray($request) {
        return parent::toArray($request);
    }
}

?>