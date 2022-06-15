<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\LikeResource;
use App\Http\Resources\OdereRsource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\RecommendedResource;
use App\Http\Resources\RumorResource;
use App\Http\Resources\SpeciallyResource;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Order;
use App\Models\Product;
use App\Models\Recommended;
use App\Models\Rumor;
use App\Models\Specially;
use Database\Seeders\SpeciallySeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
     use ApiResponseTrait;
    public function index(Request $request)
    {
         $token = auth()->user()->id;
         $Specialliest = Like::where('user_id' , $token)->orderBy('created_at', 'desc')->get();

         $categories = Category::orderBy('created_at', 'desc')->get();
         $recomended = Order::where('user_id' , $token)->orderBy('created_at', 'desc')->get();
         $products = Product::withCount('likes')->orderBy('likes_count','DESC')->paginate(8);






         $response =[
          'Specialliest' => SpeciallyResource::collection($Specialliest) ,
          'categories' => CategoryResource::collection($categories) ,
          'recomended' => OdereRsource::collection($recomended) ,
          'pupulers' => ProductResource::collection($products)  ,

         ];

        if($response){
             return $this->apiResponse( $response , true , 'ok');
        }else{
            return $this->apiResponse(null , false , 'not found');
        }
    }


    public function store(Request $request)
    {
       // validation
       $validator = Validator::make($request->all(), [
        'product_id' => 'required',
       ]);


        $errors = [];
        $errorStr = '';
        $errorArr = [];

        foreach ($validator->errors()->toArray() as $key => $error) {

            $errors[$key] = $error[0];
            $errorStr .= $error[0] ;
            array_push($errorArr , $error[0] );

            return $this->apiResponse(null , 422 , $errorStr );

        }


        $order = Order::create([
        'product_id' => $request->product_id ,
        'user_id' => auth()->user()->id
        ]);

        if($order){
        return $this->apiResponse(new OdereRsource($order) , true , 'ok');
        }else{
            return $this->apiResponse(null , false , 'not found');
        }


    }


    public function show($id)
    {
        $product = Product::with(['comments' , 'comments.user' ])->where('id' , $id)->first();
        if($product){
           return $this->apiResponse(new ProductResource($product) , true , 'ok');
        }else{
            return $this->apiResponse(null , false , 'not found');
        }
    }

    public function add_comment(Request $request)
    {
        // validation
       $validator = Validator::make($request->all(), [
        'product_id' => 'required',
        'comments' => 'nullable'
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


        $comment = Comment::create([
        'product_id' => $request->product_id ,
        'comments' => $request->comments ,
        'user_id' => auth()->user()->id
        ]);

        if($comment){
        return $this->apiResponse(new CommentResource($comment) , true , 'ok');
        }else{
            return $this->apiResponse(null , false , 'not found');
        }

    }

    public function cart()
    {
        $token = auth()->user()->id;
        $cart = Order::where('user_id' , $token)->orderBy('created_at', 'desc')->get();
        if($cart){
            return $this->apiResponse(OdereRsource::collection($cart) , true , 'ok');
        }else{
            return $this->apiResponse(null , false , 'Not found');
        }

    }


    public function product($id)
    {
        $product = Product::where('category_id' , $id)->orderBy('created_at', 'desc')->get();
        if($product){
            return $this->apiResponse(ProductResource::collection($product) , true , 'ok');
        }else{
            return $this->apiResponse(null , false , 'Not found');
        }
    }

    public function search($name)
    {
       $product = Product::where('name' , $name)->first();
       if($product){
            return $this->apiResponse(new ProductResource($product) , true  , 'ok');
       }else{
           return $this->apiResponse(null , false , 'Not found');
       }
    }




}
