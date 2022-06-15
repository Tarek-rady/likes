<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $admins = User::orderBy('created_at', 'desc')->where('role_as' , '=' , 1)->get();
         return view('backend.admins.index' , compact('admins'));

    }


    public function create()
    {
        return view('backend.admins.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => Hash::make($request->password) ,
        ]);
        toastr()->success('Admin has been saved successfully!');
        return redirect()->route('admins.index');
    }





    public function edit($id)
    {
        $admin = User::where('id' , $id)->first();
        return view('backend.admins.edit' , compact('admin'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => Hash::make($request->password) ,
        ]);
        toastr()->success('Admin has been saved successfully!');
        return redirect()->route('admins.index');
    }


    public function destroy($id)
    {
        User::destroy($id);
        toastr()->success('Admin has been deleted successfully!');
        return redirect()->route('admins.index');
    }
}
