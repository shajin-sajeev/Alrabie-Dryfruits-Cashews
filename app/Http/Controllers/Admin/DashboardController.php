<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalAdmins = User::count();
        $recentProducts = Product::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalAdmins', 'recentProducts'));
    }
}
