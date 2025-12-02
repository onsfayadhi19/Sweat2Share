<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // ou avec pagination, filtres, etc.
        return view('dashboards.admin.users', compact('users')); // ← vue correcte
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
    
    public function showUsers()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('dashboards.admin.users', compact('users'));    
    }
}
