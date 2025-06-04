<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Display a listing of the comments.
     */
    public function index(): View
    {
        $cacheKey = 'comments_' . md5(serialize([
            'post_id' => request('post_id'),
            'search' => request('search'),
            'page' => request('page', 1)
        ]));

        $comments = \App\Services\CacheService::remember($cacheKey, function() {
            return Comment::with(['post', 'post.user'])
                ->when(request('post_id'), function($query) {
                    return $query->where('post_id', request('post_id'));
                })
                ->when(request('search'), function($query) {
                    $search = '%' . request('search') . '%';
                    return $query->where(function($q) use ($search) {
                        $q->where('name', 'like', $search)
                          ->orWhere('email', 'like', $search)
                          ->orWhere('body', 'like', $search);
                    });
                })
                ->latest()
                ->paginate(15)
                ->withQueryString();
        }, 30); // Cache por 30 minutos

        $posts = \App\Services\CacheService::remember('posts_ordered_by_title', function() {
            return \App\Models\Post::orderBy('title')->get(['id', 'title']);
        }, 60); // Cache por 1 hora

        return view('comments.index', [
            'comments' => $comments,
            'posts' => $posts
        ]);
    }

    /**
     * Display the specified comment.
     */
    public function show(Comment $comment): View
    {
        $comment->load(['post', 'post.user']);
        return view('comments.show', compact('comment'));
    }
}
