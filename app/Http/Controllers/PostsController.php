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
    $posts = Post::Orderby('updated_at', 'desc')->paginate(5);
    return view('posts.index')->with('posts', $posts);

    // $posts = Post::Orderby('created_at', 'desc')->paginate(5);
    // $posts = Post::where('status', 1) // Filter posts where status is 1 (published)
    //     ->orderBy('created_at', 'desc')
    //     ->paginate(6);
  }
  // public function index()
  // {
  //     $posts = Post::with(['user', 'userUpdate'])
  //         ->orderBy('updated_at', 'desc')
  //         ->paginate(5);

  //     return view('posts.index')->with('posts', $posts);
  // }



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
      'description' => ['required', 'max:500'],
      'status' => 'nullable', // Allow the status to be optional
    ]);

    // Set the default value for status to 0 if it is not present in the request
    $status = $validatedData['status'] ?? 0;

    // Store the validated data in the session
    Session::put('post_data', [
      'title' => $validatedData['title'],
      'description' => $validatedData['description'],
      'status' => $status,
    ]);

    return view('posts.create-confirm', [
      'post' => [
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'status' => $status,
      ],
    ]);

    // Store the validated data in the session
    // Session::put('post_data', $validatedData);
    // return view('posts.create-confirm', [
    //     'post' => $validatedData, // Pass the validated data as the 'post' variable to the view
    // ]);
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
    $post->created_user_id = $user->id;
    $post->updated_user_id = $user->id;
    $post->save();

    // Clear the session data
    Session::forget('post_data');

    // return redirect()->route('posts')->with('success', '投稿が成功しました！ありがとうございます。');
    return redirect()->route('posts')->with('success', '投稿が成功しました！ありがとうございます。')->with('success_duration', 5000);
  }

  public function details(string $id)
  {
    $post = Post::findOrFail($id);
    return view('posts.details')->with('post', $post);
  }

  // Search function in posts
  public function searchPosts(Request $request)
  {
    $search = $request->input('search');
    $status = $request->input('status');
    $query = Post::query();

    if ($search) {
      $query->where(function ($query) use ($search) {
        $query->where('title', 'LIKE', '%' . $search . '%')
          ->orWhere('description', 'LIKE', '%' . $search . '%');
      });
    }

    if ($status != '') {
      if ($status == '1' || $status == '0') {
        $query->where('status', $status);
      }
    }

    $postsCount = $query->count(); //get the post count for search resaults

    $posts = $query
      ->orderBy('created_at', 'desc')
      ->paginate(5);
    return view('posts.index', compact('posts', 'search', 'status', 'postsCount'));
  }
}
