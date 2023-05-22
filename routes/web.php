<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    } else {
        return view('auth.login');
    }
});

Auth::routes();

Route::middleware(['auth', 'user.access'])->prefix('user')->name('user.')->group(function () {
    // -- User Details--
    Route::get('/details/{id}', [UserController::class, 'details'])->name('details');
    // Show the edit form
    Route::get('/details/{id}/edit', [UserController::class, 'edit'])->name('edit');
    // Handle the form submission and show the confirmation page
    Route::put('/details/{id}/edit-confirm', [UserController::class, 'editConfirm'])->name('edit-confirm');
    // Update the user information in the database
    Route::put('/details/{id}/update', [UserController::class, 'update'])->name('update');
    // End User Details --
});

Route::middleware(['auth', 'post.owner'])->prefix('post')->name('post.')->group(function () {
    // -- Post Details--
    Route::get('/details/{id}', [PostsController::class, 'details'])->name('details');
    // Show the edit form
});



Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard route
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // show post list
    Route::get('/posts', [PostsController::class, 'index'])->name('posts');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/posts/create-confirm', [PostsController::class, 'createConfirm'])->name('posts.create-confirm');
    Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/search', [PostsController::class, 'searchPosts'])->name('posts.search');
});














// Route::middleware('user')->prefix('user')->name('user.')->group(function () {

//     Route::get('/details', [UserController::class, 'showProfile'])->name('details');
//     Route::get('/profile/{id}/edit-profile', [UserController::class, 'edit'])->name('edit');
// });




// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/details', [UserController::class, 'showProfile'])->name('details');
// Route::get('/profile/{id}/edit-profile', [UserController::class, 'edit']);
// Route::put('/update-profile/{id}', [UserController::class, 'update']);




// Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');

//route for home controller
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->middleware(['auth','isAdmin']);

//route for post controller CRUD
// Route::resource('posts', PostsController::class);

// Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
// //     // Route::get('/home',[AdminController::class, 'createUser'])->('admin.home');
//     Route::get('/dashboard', [AdminController::class, 'index']);
//     // Route::get('/register', [AdminController::class, 'adduser']);
//     // Route::get('/confirmation', [AdminController::class, 'confirmation']);
//     // Route::get('/profile', [AdminController::class, 'showProfile']);
// });

// Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');







// Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');