<?php

namespace App\Http\Resources;

// collection : format dari resources nya

class UserCollection extends ResourceCollection 
{
    public function toArray($request) {
        return parent::toArray($request);
    }
}

?>