<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductController;


// traning kasir
Route::get('/kasir', [KasirController::class, 'index']);
Route::get('/kasir-table/{nama}/', [KasirController::class, 'kategori'])->name('post.kategori');
Route::get('/kasir-table', [ProductController::class, 'index'])->name('show.table');
Route::post('/kasir-table/create', [ProductController::class, 'store'])->name('create.produk');
Route::delete('/kasir-table/{id}', [ProductController::class, 'delete'])->name('post.delete');
Route::get('/kasir-table/{id}/edit', [ProductController::class, 'edit'])->name('post.edit');
Route::put('/kasir-table/{id}/posts', [ProductController::class, 'update'])->name('update.produk');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');





