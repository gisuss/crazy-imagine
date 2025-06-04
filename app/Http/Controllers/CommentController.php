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
        $comments = Comment::with(['post', 'post.user'])
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

        return view('comments.index', [
            'comments' => $comments,
            'posts' => \App\Models\Post::orderBy('title')->get()
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
