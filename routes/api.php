<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['api' , 'auth:sanctum'] ] , function(){

  Route::get('/home' , [HomeController::class , 'index']);

        // like
        Route::post('like-product/{id}' , [LikeController::class , 'store']);

        // product details
        Route::get('/product/{id}' , [HomeController::class , 'show']);
        Route::get('/category-product/{id}' , [HomeController::class , 'product']);
        Route::get('/product-search/{name}' , [HomeController::class , 'search']);




        // cart
        Route::post('/cart/create' , [HomeController::class , 'store']);
        Route::get('/cart/show' , [HomeController::class , 'cart']);


        // comment
        Route::post('/comment/create' , [HomeController::class , 'add_comment']);








  Route::post('users/logout' , [UserController::class , 'logout']);
});







  // Auth Users
  Route::group(['prefix' => 'users'] , function(){
    Route::post('/register' , [UserController::class , 'register']);
    Route::post('/update/{id}' , [UserController::class , 'update']);
    Route::post('/login' , [UserController::class , 'login']);
  });
