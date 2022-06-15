<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpeciallyResource extends JsonResource
{

    public function toArray($request)
    {
        return [

            'product_id' => $this->product_id ,

            'product' => new ProductResource($this->products)
        ];
    }
}
