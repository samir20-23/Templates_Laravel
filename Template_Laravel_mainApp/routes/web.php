<?php

use App\Models\Product;
use App\Http\Controllers\ManageProducts;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('product.index');
// })->name('product.index');

//user
Route::get('/', [ManageProducts::class, 'index'])->name('home');
Route::get('/home', [ManageProducts::class, 'index'])->name('home');
Route::get('/products', [ManageProducts::class, 'index'])->name('home');
Route::resource('products', ManageProducts::class);

// admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ManageProducts::class);
    Route::resource('users', ManageUsers::class);
});
Route::resource('admin', DashboardController::class); 
Route::resource('dashboard', DashboardController::class);


// 
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ManageProducts::class);
    Route::resource('users', ManageUsers::class);
});
// 
Route::get('/products', [ManageProducts::class, 'index'])->name('products.index');
Route::post('/products', [ManageProducts::class, 'store'])->name('products.store');
Route::get('/admin/products/create', [ManageProducts::class, 'create'])->name('admin.products.create');
Route::get('/admin/products/edit', [ManageProducts::class, 'update'])->name('admin.products.edit');
Route::get('/admin/products/show', [ManageProducts::class, 'show'])->name('admin.products.show');

// 

// Route::resource('categories', CategoryController::class);
Route::resource('products', ManageProducts::class);
Route::delete('products/{product}', [ManageProducts::class, 'destroy'])->name('products.destroy');


// Edit product route
Route::get('products/{product}/edit', [ManageProducts::class, 'edit'])->name('products.edit');

// Show product route
Route::get('products/{product}', [ManageProducts::class, 'show'])->name('products.show');

// Delete product route
Route::delete('products/{product}', [ManageProducts::class, 'destroy'])->name('products.destroy');
