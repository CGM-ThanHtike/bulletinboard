<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        $posts = Post::all();
        return view('admin.dashboard', compact('users', 'user', 'posts'));
    }

    // public function register()
    // {
    //     return view('admin.adduser');
    //     // return redirect('/admin/adduser')->with('success', 'Add user please');
    // }

    //     public function confirmation(Request $request)
    // {
    //     // Retrieve the user's data from the URL parameter
    //     $user = $request->input('user');

    //     // Pass the user's data to the view
    //     return view('admin.show', ['user' => $user]);
    // }

    //     public function showProfile()
    // {
    //     // $user = auth()->user();
    //     // return view('admin.profile', compact('user'));

    //     $user = auth()->user();
    //     // return view('admin.profile')->with('user', $user);
    //     return view('admin.profile')->with('user', $user);
    // }


}
