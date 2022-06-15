<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = user::orderBy('created_at', 'desc')->where('role_as' , '=' , 0)->get();
        return view('backend.users.index' , compact('users'));
    }



    public function create()
    {
        return view('backend.users.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'mobile' => 'required|numeric|min:6|unique:users,mobile',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'mobile' => $request->mobile ,
            'password' => $request->password ,
        ]);
        toastr()->success('user has been saved successfully!');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
       $user = User::Where('id' , $id)->first();
       return view('backend.users.edit' , compact('user'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100',
            'mobile' => 'required|numeric|min:6|unique:users,mobile',
            'password' => 'required'
        ]);

        $user =user::findOrFail($id);
        $user->update([
            'name' => $request->name ,
            'email' => $request->email ,
            'mobile' => $request->mobile ,
            'password' => $request->password ,
        ]);

        toastr()->success('user has been Update successfully!');
        return redirect()->route('users.index');


    }


    public function destroy($id)
    {
       user::destroy($id);
        toastr()->success('Data has been deleted successfully!');
        return redirect()->route('users.index');
    }
}
