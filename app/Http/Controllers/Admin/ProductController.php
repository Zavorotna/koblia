<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'attributes')
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::with('values')->get();
        return view('admin.products.create', compact('categories', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['is_top'] = $request->has('is_top');
        $attributes = $data['attributes'] ?? [];
        unset($data['attributes'], $data['main_image']);

        $attributes = $request->input('attributes', []);
        
        $product = Product::createProduct($data, $attributes);

        if ($request->hasFile('main_image')) {
            $file = $request->file('main_image');
            $product->clearMediaCollection('main');
            $product->addMedia($file)
                ->usingFileName($file->getClientOriginalName())
                ->withCustomProperties([
                    'alt' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) // ім’я файлу без розширення
                ])
                ->toMediaCollection('main');
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $product->addMedia($file)
                    ->usingFileName($file->getClientOriginalName())
                    ->withCustomProperties([
                        'alt' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    ])
                    ->toMediaCollection('gallery');
            }
        }


        return to_route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $attributes = Attribute::with('values')->get();
        return view('admin.products.edit', compact('product', 'categories', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['is_top'] = $request->has('is_top');
        $attributes = $data['attributes'] ?? [];
        unset($data['attributes'], $data['main_image']);

        $product->updateProduct($data, $attributes);
        if ($request->hasFile('main_image')) {
            $product->clearMediaCollection('main');
            $product->addMedia($request->file('main_image'))
                ->toMediaCollection('main');
        }
        if ($request->hasFile('gallery')) {
            $product->addGalleryImages($request->file('gallery'));
        }

        return to_route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return to_route('products.index');
    }
}
