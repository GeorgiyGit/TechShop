<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCharacteristic;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $products = Product::with(['brand', 'category', 'firstImage'])
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->orderBy('name')
            ->get();

        return view('admin.products.index', compact('products', 'categories', 'search', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->orderBy('name')
            ->get();
        $brands = Brand::orderBy('name')->get();

        return view('admin.products.form', [
            'product' => null,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $product = Product::create($data);

        $this->saveImages($product, $request);
        $this->saveCharacteristics($product, $request);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $product->load(['characteristics', 'images']);
        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->orderBy('name')
            ->get();
        $brands = Brand::orderBy('name')->get();

        return view('admin.products.form', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|max:5120',
        ]);

        $product->update($data);

        if ($request->hasFile('images')) {
            $this->saveImages($product, $request);
        }

        $this->saveCharacteristics($product, $request);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            $path = public_path('images/products/' . $image->url);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    public function destroyImage(ProductImage $image)
    {
        $productId = $image->product_id;
        $path = public_path('images/products/' . $image->url);

        if (file_exists($path)) {
            unlink($path);
        }

        $image->delete();

        return redirect()->route('admin.products.edit', $productId)->with('success', 'Image deleted.');
    }

    private function saveImages(Product $product, Request $request): void
    {
        if (!$request->hasFile('images')) {
            return;
        }

        $position = $product->images()->max('position') ?? 0;

        foreach ($request->file('images') as $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);

            ProductImage::create([
                'product_id' => $product->id,
                'url' => $filename,
                'position' => ++$position,
            ]);
        }
    }

    private function saveCharacteristics(Product $product, Request $request): void
    {
        $names = $request->input('char_name', []);
        $values = $request->input('char_value', []);

        $product->characteristics()->delete();

        foreach ($names as $i => $name) {
            $name = trim($name);
            $value = trim($values[$i] ?? '');
            if ($name === '' || $value === '') {
                continue;
            }

            ProductCharacteristic::create([
                'product_id' => $product->id,
                'name' => $name,
                'value' => $value,
                'position' => $i + 1,
            ]);
        }
    }
}
