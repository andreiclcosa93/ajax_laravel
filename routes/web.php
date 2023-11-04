<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;



// view dashboard
Route::get('/', [ProductController::class, 'home'])->name('home');

// view blade products
Route::get('products', [ProductController::class, 'index'])->name('view.products');

// show products
Route::get('show-products', [ProductController::class, 'showProduct']);

// add products
Route::post('products-store', [ProductController::class, 'store']);

// show edit prod
Route::get('edit-product/{id}', [ProductController::class, 'product']);

// update product
Route::put('update-product/{id}', [ProductController::class, 'updateProduct']);
