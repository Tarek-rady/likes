<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function index()
    {
        $admins = User::count();
        $categories = Category::count();
        $products = Product::count();

        return view('dashboard' , compact('admins' , 'categories' , 'products'));
    }
}
