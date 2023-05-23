<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
    // $posts = Post::Orderby('updated_at', 'desc')->paginate(5);
    // return view('posts.index')->with('posts', $posts);

    $user = Auth::user();
    if ($user->role == '2') {
      $posts = Post::where('created_user_id', $user->id)
        ->orderBy('updated_at', 'desc')
        ->paginate(5);
    } else {
      $posts = Post::orderBy('updated_at', 'desc')
        ->paginate(5);
    }

    return view('posts.index')->with('posts', $posts);
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

    $validator = Validator::make($request->all(), [
      'search' => 'nullable|string|max:255',
      'status' => 'nullable|in:0,1',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }
    $search = $request->input('search');
    $status = $request->input('status');
    $query = Post::query();

    if ($search) {
      $query->where(function ($query) use ($search) {
        $query->where('title', 'LIKE', '%' . $search . '%')
          ->orWhere('description', 'LIKE', '%' . $search . '%');
      });
    }

    if ($status !== '') {
      if ($status === '1' || $status === '0') {
        $query->where('status', $status);
      }
    }
    // Get the authenticated user
    $user = Auth::user();

    // If the user is not an admin (role 1), restrict posts to their own created posts
    if ($user->role != '1') {
      $query->where('created_user_id', $user->id);
    }

    $postsCount = $query->count(); //get the post count for search resaults

    $postDownload = $query->get();
    // Store the search results in the session
    session(['searchPosts' => $postDownload]);

    $posts = $query
      ->orderBy('created_at', 'desc')
      ->paginate(5);


    return view('posts.index', compact('posts', 'search', 'status', 'postsCount'));
  }
  public function downloadPostsCsv()
  {
    // Retrieve the search results from the session
    $posts = session('searchPosts');

    // Forget/remove the session data
    session()->forget('searchPosts');

    if ($posts !== null && $posts->count() > 0) {
      // Create a CSV string
      $csvContent = '';

      // Add the CSV headers
      $csvContent .= "Title,Description,Created_User,Created_at,Updated_User,Updated_at,Status\n";

      // Add the post data to the CSV
      foreach ($posts as $post) {
        // Encode Japanese characters using mb_convert_encoding
        $title = mb_convert_encoding($post->title, 'SJIS', 'UTF-8');
        $description = mb_convert_encoding($post->description, 'SJIS', 'UTF-8');
        $status = $post->status;
        $created_user = mb_convert_encoding($post->user->name, 'SJIS', 'UTF-8');
        $created_at = $post->created_at;
        $updated_user = mb_convert_encoding($post->userUpdate->name, 'SJIS', 'UTF-8');
        $updated_at = $post->updated_at;

        $csvContent .= "{$title},{$description},{$created_user},{$created_at},{$updated_user},{$updated_at},{$status}\n";
      }

      // Set the response headers
      $headers = [
        'Content-Type' => 'text/csv;',
        'Content-Disposition' => 'attachment; filename="posts.csv"',
      ];

      // Return the CSV as a downloadable file
      return response()->streamDownload(
        function () use ($csvContent) {
          echo $csvContent;
        },
        'posts.csv',
        $headers
      );
    } else {
      return redirect()->back()->with('error', '検索結果は０件です。先に検索してからダウンロードをしてください');
    }
  }

  public function uploadPostsCsv(Request $request)
  {
    // Validate the uploaded file
    $validator = Validator::make($request->all(), [
      'csv_file' => 'required|mimes:csv,txt|max:2048',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    // Check if the file was successfully uploaded
    if ($request->hasFile('csv_file')) {
      $csvFile = $request->file('csv_file');

      // Get the authenticated user
      $user = Auth::user();

      // Store the file in the user's directory
      $filePath = $csvFile->storeAs('public/' . $user->id, $csvFile->getClientOriginalName());

      // Get the stored file's full path
      $fullPath = Storage::path($filePath);

      // Read the CSV file
      $fileData = array_map('str_getcsv', file($fullPath));

      // Validate the file structure (e.g., two columns: title and description)
      if (count($fileData[0]) !== 2 || $fileData[0][0] !== 'title' || $fileData[0][1] !== 'description') {
        return redirect()->back()->with('error', 'Invalid file structure. The CSV file must have two columns: "title" and "description".');
      }

      // Remove the header row
      array_shift($fileData);

      // Process and save the data to the posts table
      foreach ($fileData as $row) {
        $title = $row[0];
        $description = $row[1];

        // Create a new post instance and assign the values
        $post = new Post();
        $post->title = $title;
        $post->description = $description;
        $post->created_user_id = $user->id;
        $post->save();
      }

      // Redirect to the post index view
      return redirect()->route('posts.index')->with('success', 'CSV file uploaded and data saved successfully.');
    }

    // Redirect back with error message if no file was uploaded
    return redirect()->back()->with('error', 'Failed to upload CSV file.');
  }
}