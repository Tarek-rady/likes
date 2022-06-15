<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\LikeResource;
use App\Models\Like;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    use ApiResponseTrait;



    public function store(Request $request , $id)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'nullable',
        ]);

        $errors = [];
        $errorStr = '';
        $errorArr = [];

        foreach ($validator->errors()->toArray() as $key => $error) {

            $errors[$key] = $error[0];
            $errorStr .= $error[0] ;
            array_push($errorArr , $error[0] );

            return $this->apiResponse(null , false , $errorStr );

        }

      //  $user_id = auth()->user()->id;
        $likes = Like::where('user_id' ,  auth()->user()->id)->get();
        $like =  $likes->where('product_id' , $id)->first();

        if($like != null){
              $product_id = Like::where('user_id' ,  auth()->user()->id)->where('product_id' , $id)->delete();
              return $this->apiResponse(false , true , 'data deleted sucessfully');
        }else{

            $like = Like::create([
                'product_id' => $request->id ,
                'user_id' => auth()->user()->id
            ]);

            return $this->apiResponse(true , true , 'ok');
        }

    }
}
