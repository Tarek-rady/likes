<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('backend.products.index' , compact('products'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('backend.products.create' , compact('categories'));
    }


    public function store(Request $request)
    {


        $file_name = '';

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $file_name = $image->getClientOriginalName();
        }
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'img' => 'required|mimes:png,jpg',
            'desc' => 'required',
            'category_id' => 'required',
        ]);

        $product = Product::create([
            'name' => $request->name ,
            'price' => $request->price ,
             'img' =>$file_name  ,
            'desc' => $request->desc ,
             'category_id' => $request->category_id
        ]);

        if ($request->hasFile('img')) {
            // move pic
            $request->img->move(public_path('Attachments/products/'), $file_name);
        }

        toastr()->success('products has been saved successfully!');
        return redirect()->route('products.index');

    }



    public function edit($id)
    {
        $categories = Category::get();
        $product = Product::where('id' , $id)->first();

        return view('backend.products.edit' , compact('categories' , 'product'));

    }


    public function update(Request $request, $id)
    {

        $new_file_name = '';
        $old_file_name = '';
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'img' => 'nullable|mimes:png,jpg',
            'desc' => 'required',
            'category_id' => 'required',
        ]);
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name ,
            'price' => $request->price ,
            'desc' => $request->desc ,
             'category_id' => $request->category_id
        ]);

        if ($request->hasFile('img')) {
            $new_file_name = $request->file('img')->getClientOriginalName();
            $old_file_name = $product->img;
            $product->img = $new_file_name ;
        }

        if ($request->hasFile('img')) {
            // move img
            Storage::disk('products')->delete($old_file_name);
            $request->img->move(public_path('Attachments/products/'), $new_file_name);
        }
        $product->save();

        toastr()->success('Data has been saved successfully!');
        return redirect()->route('products.index');


    }


    public function destroy($id)
    {
        $old_file_name = '';

        $product = Product::where('id' , $id)->first();
        $product->id = $id;

        $old_file_name = $product->img;

        if (!empty($product->name)) {

            Storage::disk('products')->delete($old_file_name);
        }

        Product::destroy($id);
        toastr()->success('Data has been deleted successfully!');
        return redirect()->route('products.index');

    }
}
