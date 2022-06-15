<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OdereRsource extends JsonResource
{

    public function toArray($request)
    {
        return [
          'id' => $this->id ,
          'product_id' => $this->product_id ,
          'product' => new ProductResource($this->products) ,

          'user_id' => $this->user_id ,
          'user' => new UserResource($this->user)
        ];
    }
}
