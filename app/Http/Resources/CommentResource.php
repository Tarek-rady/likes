<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{

    public function toArray($request)
    {
        return [

            'comments' => $this->comments ,
            'product_id' => $this->product_id ,
            'user_id' => $this->user_id ,
            'user' =>new UserResource($this->user) ,





        ];
    }
}
