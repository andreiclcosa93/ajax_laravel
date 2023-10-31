<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     // return view('welcome');
//     return view('template');
// })->name('dashboard');

// view dashboard
Route::get('/', [ProductController::class, 'home'])->name('home');


// view blade products
Route::get('products', [ProductController::class, 'index'])->name('view.products');
