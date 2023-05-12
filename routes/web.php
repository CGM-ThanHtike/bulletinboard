<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    } else {
        return view('auth.login');
    }
});

Auth::routes();

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard route
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Admin profile route
    // Route::get('profile', [AdminController::class, 'showProfile'])->name('profile');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
Route::get('/profile/{id}/edit-profile', [UserController::class, 'edit']);
Route::put('/update-profile/{id}', [UserController::class, 'update']);




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
