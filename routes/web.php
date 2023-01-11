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

Route::get('/', [ProductController::class, 'show_products'])->name('products.show');
Route::get('/products/create', [ProductController::class, 'show_create_product'])->name('product.show_create');
Route::get('/products/{id}/edit', [ProductController::class, 'show_update_product'])->name('product.show_update');
Route::get('/products/{id}', [ProductController::class, 'show_product'])->name('product.show');
Route::delete('/products/{id}', [ProductController::class, 'delete_product'])->name('product.delete');
Route::post('/products', [ProductController::class, 'create_update_product'])->name('product.create');
Route::patch('/products/{id}', [ProductController::class, 'create_update_product'])->name('product.update');
