<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ProductController;

Route::get('/form', [RentalController::class,'index'])->name('show.form');
Route::post('/form', [RentalController::class, 'store'])->name('form.submit');

Route::get('/', [RentalController::class, 'show'])->name('table.data');
Route::get('/posts/{id}', [RentalController::class, 'edit'])->name('rental.edit');
Route::put('/posts/{id}/update', [RentalController::class, 'update'])->name('rental.update');
Route::delete('/table-data/{id}', [RentalController::class, 'destroy'])->name('rental.destroy');


//traning crud
Route::get('/formsec', [PostController::class, 'index'])->name('show.formsec');
Route::post('/formsec/create-data', [PostController::class, 'store'])->name('post.data');
Route::get('/formsec/table-data', [PostController::class, 'show'])->name('table.sec');
Route::get('/formsec/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::PUT('/posts/{id}/', [PostController::class, 'update'])->name('post.update');
Route::delete('/delete/{id}/', [PostController::class, 'destroy'])->name('post.destroy');

// traning kasir
Route::get('/kasir', [KasirController::class, 'index']);
Route::get('/kasir-table/{nama}/', [KasirController::class, 'kategori'])->name('post.kategori');
Route::get('/kasir-table', [ProductController::class, 'index'])->name('show.table');
Route::post('/kasir-table/create', [ProductController::class, 'store'])->name('create.produk');
Route::delete('/kasir-table/{id}', [ProductController::class, 'delete'])->name('post.delete');

// Route::post('/cart/add/{id}', [CartController::class, 'add']);
// Route::post('/cart/update/{id}', [CartController::class, 'update']);
// Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');





