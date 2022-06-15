<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table ='comments';

    protected $fillable = ['user_id' , 'product_id' , 'comments'];

    public function products()
    {
       return $this->belongsTo(Product::class , 'product_id');
    }

    public function user()
    {
       return $this->belongsTo(User::class , 'user_id');
    }
}
