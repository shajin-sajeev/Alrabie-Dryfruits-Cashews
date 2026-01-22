<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalAdmins = Admin::count();
        $recentProducts = Product::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalAdmins', 'recentProducts'));
    }
}
