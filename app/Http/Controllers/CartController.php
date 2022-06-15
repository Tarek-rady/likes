<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
   public function order()
   {
       $orders = Order::orderBy('created_at', 'desc')->get();

       return view('backend.home.order' , compact('orders'));
   }

   public function like()
   {
       $likes = Like::orderBy('created_at', 'desc')->get();
        return view('backend.home.like' , compact('likes'));
   }


   public function comment()
   {
       $comments = Comment::orderBy('created_at', 'desc')->get();

       return view('backend.home.comment' , compact('comments'));
   }


}
