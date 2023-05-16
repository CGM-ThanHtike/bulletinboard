<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
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

    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::Orderby('created_at', 'desc')->paginate(4);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new posts.
     */
    public function create()
    {
        return view('posts.create');
    }

    public function createConfirm(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => 'required',
        ]);

        // Store the validated data in the session
        Session::put('post_data', $validatedData);
        return view('posts.create-confirm', [
            'post' => $validatedData, // Pass the validated data as the 'post' variable to the view
        ]);
    }

    public function store()
    {
        // Retrieve the post data from the session
        $post_data = Session::get('post_data');

        // Create the post and save it to the database
        $post = new Post();
        $post->title = $post_data['title'];
        $post->description = $post_data['description'];
        $post->status = $post_data['status'];

        // Assuming you have a user associated with the post
        $user = auth()->user(); // Retrieve the authenticated user or adjust accordingly

        // Assign the user's attributes to the post
        $post->created_user_id = $user->created_user_id;
        $post->updated_user_id = $user->updated_user_id;
        $post->save();

        // Clear the session data
        Session::forget('post_data');

        return redirect()->route('posts')->with('success', 'Post created successfully.');
    }
}
