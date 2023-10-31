<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// view blade products
Route::get('products', [ProductController::class, 'index']);
