<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPostOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $postId = $request->route('id');
        $user = Auth::user();

        $post = Post::findOrFail($postId);
        $createdUserId = $post->created_user_id;

        if ($user->role == '1' || ($user->role == '2' && $user->id == $createdUserId)) {
            // Allow access if the user is an admin or the owner of the post
            return $next($request);
        } else {
            // Otherwise, abort with a 403 Forbidden error
            abort(403);
        }
    }
}