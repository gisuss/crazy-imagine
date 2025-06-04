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
        $cacheKey = 'posts_' . md5(serialize([
            'user_id' => request('user_id'),
            'search' => request('search'),
            'page' => request('page', 1)
        ]));

        $posts = \App\Services\CacheService::remember($cacheKey, function() {
            return Post::with(['user', 'comments'])
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
        }, 30); // Cache por 30 minutos

        $users = \App\Services\CacheService::remember('users_ordered_by_name', function() {
            return \App\Models\User::orderBy('name')->get();
        }, 60); // Cache por 1 hora
            
        return view('posts.index', [
            'posts' => $posts,
            'users' => $users
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
