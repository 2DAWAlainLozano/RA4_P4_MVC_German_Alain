<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = User::count();
        $postCount = Post::count();
        $commentCount = Comment::count();
        return view('admin.dashboard', compact('userCount', 'postCount', 'commentCount'));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'User role updated.');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function posts()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.posts', compact('posts'));
    }

    public function comments()
    {
        $comments = Comment::with(['user', 'post'])->orderBy('created_at', 'desc')->get();
        return view('admin.comments', compact('comments'));
    }
}
