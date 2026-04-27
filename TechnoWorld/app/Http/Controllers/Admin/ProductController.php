<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCharacteristic;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        $products = Product::with(['category', 'firstImage'])
            ->when($search, fn($q) => $q->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            }))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories', 'search', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
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
            'name'              => 'required|string|max:255',
            'brand'             => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'short_description' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'stock_left'        => 'required|integer|min:0',
            'images.*'          => 'nullable|image|max:5120',
            'char_name'         => 'nullable|array',
            'char_value'        => 'nullable|array',
        ]);

        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['is_active'] = true;

        $product = Product::create($data);

        $this->saveImages($request, $product);
        $this->saveCharacteristics($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $product->load(['images', 'characteristics']);

        return view('admin.products.form', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'brand'             => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'short_description' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'stock_left'        => 'required|integer|min:0',
            'images.*'          => 'nullable|image|max:5120',
            'char_name'         => 'nullable|array',
            'char_value'        => 'nullable|array',
        ]);

        if ($product->name !== $data['name']) {
            $data['slug'] = $this->uniqueSlug($data['name'], $product->id);
        }

        $product->update($data);

        if ($request->hasFile('images')) {
            $this->saveImages($request, $product);
        }

        $product->characteristics()->delete();
        $this->saveCharacteristics($request, $product);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            $path = public_path('images/products/' . $image->image_path);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;

        while (
            Product::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function saveImages(Request $request, Product $product): void
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
                'image_path' => $filename,
                'position'   => ++$position,
            ]);
        }
    }

    private function saveCharacteristics(Request $request, Product $product): void
    {
        $names = $request->input('char_name', []);
        $values = $request->input('char_value', []);

        foreach ($names as $i => $name) {
            $name = trim($name);
            $value = trim($values[$i] ?? '');
            if ($name === '' || $value === '') {
                continue;
            }

            ProductCharacteristic::create([
                'product_id' => $product->id,
                'name'       => $name,
                'value'      => $value,
                'position'   => $i + 1,
            ]);
        }
    }
}
