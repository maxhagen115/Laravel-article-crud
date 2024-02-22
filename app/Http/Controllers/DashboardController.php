<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalBlogs = Blog::count();
        $todayBlogs = Blog::whereDate('created_at', $todayDate)->count();
        $thisMonthBlogs = Blog::whereMonth('created_at', $thisMonth)->count();
        $thisYearBlogs = Blog::whereYear('created_at', $thisYear)->count();

        return view('dashboard', compact('totalUsers', 'totalBlogs', 'todayBlogs', 'thisMonthBlogs', 'thisYearBlogs'));
    }
}
