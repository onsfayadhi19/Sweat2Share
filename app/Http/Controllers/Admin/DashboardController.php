<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $totalUsers = User::count();
        return view('dashboards.admin.dashboard', compact('totalUsers','recentUsers'));
    }
    
}
