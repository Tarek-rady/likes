<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\productController;
use App\Http\Controllers\RecommendedController;
use App\Http\Controllers\RumorController;
use App\Http\Controllers\SpeciallyController;
use App\Http\Controllers\UserController;
use App\Models\Recommended;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'] , function(){

    Route::resource('/users' , UserController::class);
    Route::resource('/admins' , AdminController::class);
    Route::resource('/products' , productController::class);
    Route::resource('/categories' , CategoryController::class);
    Route::resource('/speciallies' , SpeciallyController::class);

    Route::get('/user-order' , [CartController::class , 'order'])->name('user.order');
    Route::get('/user-like' , [CartController::class , 'like'])->name('user.like');
    Route::get('/user-comment' , [CartController::class , 'comment'])->name('user.comment');

});



require __DIR__.'/auth.php';
