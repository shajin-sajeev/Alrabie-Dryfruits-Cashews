<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->paginate(12);
        return view('frontend.index', compact('categories', 'products'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $products = Product::where('category_id', $category->id)->paginate(12);
        return view('frontend.category', compact('category', 'categories', 'products'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $categories = Category::all();
        $products = Product::where(function ($q) use ($query) {
            $q->where('name', 'ilike', "%{$query}%")
                ->orWhere('description', 'ilike', "%{$query}%");
        })
            ->with('category')
            ->paginate(12);
        return view('frontend.search', compact('products', 'categories', 'query'));
    }
}
