<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;



// view dashboard
Route::get('/', [ProductController::class, 'home'])->name('home');

// view blade products
Route::get('products', [ProductController::class, 'index'])->name('view.products');

// add products
Route::post('products-store', [ProductController::class, 'store']);
