<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecommendedResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'product_id' => $this->product_id ,

            'product' => new ProductResource($this->products)
        ];
    }
}
