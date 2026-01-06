<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Site\SiteProductController;
use App\Http\Controllers\Admin\AttributeValueController;

Route::get('/admin', function () {
    return to_route('login');
});

/* =================================== */
/*             Admin panel             */
/* =================================== */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('category.index');
        Route::get('/category/create', 'create')->name('category.create');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::patch('/category/update/{id}', 'update')->name('category.update');
        Route::delete('/category/destroy/{id}', 'destroy')->name('category.destroy');
    });
    Route::controller(AttributeController::class)->group(function () {
        Route::get('/attributes', 'index')->name('attribute.index');
        Route::get('/attribute/create', 'create')->name('attribute.create');
        Route::post('/attribute/store', 'store')->name('attribute.store');
        Route::get('/attribute/edit/{id}', 'edit')->name('attribute.edit');
        Route::patch('/attribute/update/{id}', 'update')->name('attribute.update');
        Route::delete('/attribute/destroy/{id}', 'destroy')->name('attribute.destroy');
    });
    Route::controller(AttributeValueController::class)->group(function () {
        Route::get('/attribute_values', 'index')->name('attribute_values.index');
        Route::get('/attribute_values/create', 'create')->name('attribute_values.create');
        Route::post('/attribute_values/store', 'store')->name('attribute_values.store');

        Route::get('/attribute_values/edit/{attribute_value}', 'edit')->name('attribute_values.edit');
        Route::patch('/attribute_values/update/{attribute_value}', 'update')->name('attribute_values.update');
        Route::delete('/attribute_values/destroy/{attribute_value}', 'destroy')->name('attribute_values.destroy');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/create', 'create')->name('admin.products.create');
        Route::post('/products/store', 'store')->name('products.store');

        Route::get('/products/edit/{product}', 'edit')->name('admin.products.edit');
        Route::patch('/products/update/{product}', 'update')->name('admin.products.update');
        Route::delete('/products/destroy/{product}', 'destroy')->name('admin.products.destroy');
    });
});


Route::controller(SiteProductController::class)->group(function() {
    Route::get('/', 'index')->name('site.index');
    Route::get('/catalogue', 'catalogue')->name('site.catalogue');
    Route::get('/product/{id}', 'product')->name('site.product');
});

Route::controller(OrderController::class)->group(function(){
        Route::post('/orderStore', 'store')->name('site.orderStore');
    });

Route::view('/privacy', 'privacy')->name('privacy');

require __DIR__.'/auth.php';
