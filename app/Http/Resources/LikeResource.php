<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id ,
            'user' =>new UserResource($this->user) ,

            'product_id' => $this->product_id ,
            'product' => new ProductResource($this->products)
        ];
    }
}
