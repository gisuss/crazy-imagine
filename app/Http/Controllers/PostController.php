<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index(): View
    {
        $posts = Post::with(['user', 'comments'])
            ->when(request('user_id'), function($query) {
                return $query->where('user_id', request('user_id'));
            })
            ->when(request('search'), function($query) {
                $search = '%' . request('search') . '%';
                return $query->where(function($q) use ($search) {
                    $q->where('title', 'like', $search)
                      ->orWhere('body', 'like', $search);
                });
            })
            ->withCount('comments')
            ->latest()
            ->paginate(10)
            ->withQueryString();
            
        return view('posts.index', [
            'posts' => $posts,
            'users' => \App\Models\User::orderBy('name')->get()
        ]);
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post): View
    {
        $post->load([
            'user',
            'comments' => function ($query) {
                $query->latest();
            }
        ]);
        
        return view('posts.show', compact('post'));
    }
}
