<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteProductController extends Controller
{
    public function index()
    {
        $topProducts = Product::topProducts();
        
        return view('site.index', compact('topProducts'));
    }

    public function product($id)
    {
        $product = Product::getProductWithAttributes($id);
        
        $attributes = $product->attributeValues->groupBy(function($value) {
            return $value->attribute->name;
        });
        
        return view('site.product', compact('product', 'attributes'));
    }

    public function catalogue(Request $request)
    {
        $categoryId = $request->get('category');
        $categories = Category::all();
        $products = Product::getCatalogueProducts($categoryId);

        if ($request->ajax()) {
            return view('components.catalogue_page', compact('products'))->render();
        }

        return view('site.catalogue', compact('products', 'categories', 'categoryId'));
    }

}
