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
}
