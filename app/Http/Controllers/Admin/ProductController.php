<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Returns the configured default filesystem disk name.
     * Uses FILESYSTEM_DISK env var — 's3' on Vercel, 'public' locally.
     */
    private function storageDisk(): string
    {
        return config('filesystems.default', 'public');
    }

    public function index(Request $request)
    {
        $query = Product::with('category');
        $categories = Category::all();

        if ($request->has('categories') && !empty($request->categories)) {
            $categoryIds = is_array($request->categories) ? $request->categories : [$request->categories];
            $query->whereIn('category_id', $categoryIds);
        }

        $products = $query->paginate(10)->appends($request->query());

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'quantity'    => 'required|integer|min:0',
            'unit'        => 'required|string|max:50',
        ]);

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path     = $file->storeAs('images/products', $filename, $this->storageDisk());
            $validated['image'] = $path;
        }

        $validated['slug'] = Str::slug($validated['name']);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'quantity'    => 'required|integer|min:0',
            'unit'        => 'required|string|max:50',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image from the configured disk
            if ($product->image) {
                Storage::disk($this->storageDisk())->delete($product->image);
            }

            $file     = $request->file('image');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $path     = $file->storeAs('images/products', $filename, $this->storageDisk());
            $validated['image'] = $path;
        }

        $validated['slug'] = Str::slug($validated['name']);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk($this->storageDisk())->delete($product->image);
        }
        $product->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.',
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
