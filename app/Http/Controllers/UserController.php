<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //     public function showProfile()
    // {
    //     $user = Auth::user();
    //     $name = $user->name;
    //     $email = $user->email;

    //     return view('admin.profile')->with('name',$name);
    // }

    public function showProfile()
    {
        // $user = auth()->user();
        // return view('admin.profile', compact('user'));

        $user = auth()->user();
        // return view('admin.profile')->with('user', $user);
        return view('user.profile')->with('user', $user);
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user.edit-profile')->with('user', $user);
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'birthday'=>['nullable'],
            'profile' => ['required', 'string'],
            'phone'=>['nullable'],
            'address'=>['nullable'],
        ]);
        
        //create post
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->birthday = $request->input('birthday');
        $user->profile = $request->input('profile');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();

        return redirect('/admin/dashboard')->with('success', 'User Updated');
        
    }
}
