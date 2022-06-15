<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('backend.categories.index' , compact('categories'));
    }


    public function create()
    {
        return view('backend.categories.create');
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
            'img' => 'required'
        ]);

        Category::create([
            'name' => $request->name ,
            'img' =>$file_name  ,

        ]);

        if ($request->hasFile('img')) {
            // move pic
            $request->img->move(public_path('Attachments/categories/'), $file_name);
        }
        toastr()->success('categories has been saved successfully!');
        return redirect()->route('categories.index');
    }


    public function edit($id)
    {
        $category = Category::where('id' , $id)->first();
        return view('backend.categories.edit' , compact('category'));
    }


    public function update(Request $request, $id)
    {

        $new_file_name = '';
        $old_file_name = '';
        $validated = $request->validate([
            'name' => 'required',
            'img' => 'nullable'
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name
        ]);

        if ($request->hasFile('img')) {
            $new_file_name = $request->file('img')->getClientOriginalName();
            $old_file_name = $category->img;
            $category->img = $new_file_name ;
        }

        if ($request->hasFile('img')) {
            // move img
            Storage::disk('category')->delete($old_file_name);
            $request->img->move(public_path('Attachments/products/'), $new_file_name);
        }
        $category->save();
        toastr()->success('categories has been saved successfully!');
        return redirect()->route('categories.index');
    }


    public function destroy($id)
    {
        $old_file_name = '';

        $category = Category::where('id' , $id)->first();
        $category->id = $id;

        $old_file_name = $category->img;

        if (!empty($category->name)) {

            Storage::disk('category')->delete($old_file_name);
        }

        $cat = Product::Where('category_id' , $id)->first();

        if($cat){
            toastr()->error('لا يمكن حذف هذا العنصر لانه مستعمل  ف السيرفر');
            return redirect()->route('categories.index');
        }else{
            Category::destroy($id);
            toastr()->success('Data has been deleted successfully!');
            return redirect()->route('categories.index');
        }



    }
}
