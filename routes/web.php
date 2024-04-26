<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/products', [ProductController::class, 'product_index'])->name('Product.index');
Route::get('/products/create', [ProductController::class, 'product_create_index'])->name('ProductCreate.index');
Route::post('/products/create',[\App\Http\Controllers\ProductController::class,'store_product'])->name('product.store');
