<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(): View
    {
        $users = User::with(['address', 'company'])
            ->orderBy('name')
            ->paginate(10);
            
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): View
    {
        $user->load([
            'address',
            'company',
            'posts' => function ($query) {
                $query->latest()->limit(5);
            }
        ]);
        
        return view('users.show', compact('user'));
    }
}
