<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name' ,'price' ,'img' ,'desc', 'category_id' ];
    protected $appends = ['like'];

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function comments()
    {
       return $this->hasMany(Comment::class , 'product_id');
    }

    public function likes()
    {
       return $this->hasMany(Like::class , 'product_id');
    }


    public function getlikeAttribute()
    {
           $products = Product::select('id')->get();

           foreach ($products as $product) {

            $id = $product->id;

           }

            $like = Like::where('product_id' , $this->id)->first();

            if($like){
                 return true;
            }else{
                return false ;
            }



    }

}
