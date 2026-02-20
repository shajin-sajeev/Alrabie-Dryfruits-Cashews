<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Convert an uploaded file to a Base64 data URI.
     * This is stored in the database so images persist across Vercel's stateless instances.
     */
    private function encodeImageAsBase64(\Illuminate\Http\UploadedFile $file): string
    {
        $data = base64_encode(file_get_contents($file->getPathname()));
        return 'data:' . $file->getMimeType() . ';base64,' . $data;
    }

    public function index(Request $request)
    {
        $query      = Product::with('category');
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
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'quantity'    => 'required|integer|min:0',
            'unit'        => 'required|string|max:50',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->encodeImageAsBase64($request->file('image'));
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
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'quantity'    => 'required|integer|min:0',
            'unit'        => 'required|string|max:50',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->encodeImageAsBase64($request->file('image'));
        }

        $validated['slug'] = Str::slug($validated['name']);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
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
