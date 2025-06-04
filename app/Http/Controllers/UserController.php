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
        $cacheKey = 'users_' . request('page', 1);
        
        $users = \App\Services\CacheService::remember($cacheKey, function() {
            return User::with(['address', 'company'])
                ->orderBy('name')
                ->paginate(10);
        }, 60); // Cache por 1 hora
            
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): View
    {
        $cacheKey = 'user_' . $user->id . '_with_relations';
        
        $user = \App\Services\CacheService::remember($cacheKey, function() use ($user) {
            $user->load([
                'address',
                'company',
                'posts' => function ($query) {
                    $query->latest()->limit(5);
                }
            ]);
            return $user;
        }, 30); // Cache por 30 minutos
        
        return view('users.show', compact('user'));
    }
}
