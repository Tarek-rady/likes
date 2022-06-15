<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'  => $this->id,
            'name'  => $this->name,
            'price' => $this->price ,
            'img'  => url( 'Attachments/products/'. $this->img),
            'desc' => $this->desc ,
            'category_id' => $this->category->name ,
            'rate' => $this->rate ,
            'like' => $this->like ,

            'comments' => $this->comments ,
        ];
    }
}
