<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specially extends Model
{
    use HasFactory;
    protected $table ='speciallies';

    protected $fillable =['product_id'];

    public function products()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }
}
