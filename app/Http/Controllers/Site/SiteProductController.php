<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

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
}
