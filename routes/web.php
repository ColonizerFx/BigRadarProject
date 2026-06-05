<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Public Front-End Routes
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/products/{id}', [App\Http\Controllers\PageController::class, 'productDetails'])->name('products.details');
Route::get('/marketplace', [App\Http\Controllers\PageController::class, 'marketplace'])->name('marketplace.index');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContact'])->name('contact.store');

// Admin / Authenticated Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Phase 3 Features (Cart, Wishlist, Marketplace)
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
    
    Route::post('/wishlist/toggle', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
    
    Route::get('/marketplace/create', [\App\Http\Controllers\MarketplaceController::class, 'create'])->name('marketplace.create');
    Route::post('/marketplace', [\App\Http\Controllers\MarketplaceController::class, 'store'])->name('marketplace.store');
    Route::get('/marketplace/{id}/edit', [\App\Http\Controllers\MarketplaceController::class, 'edit'])->name('marketplace.edit');
    Route::put('/marketplace/{id}', [\App\Http\Controllers\MarketplaceController::class, 'update'])->name('marketplace.update');
    Route::delete('/marketplace/{id}', [\App\Http\Controllers\MarketplaceController::class, 'destroy'])->name('marketplace.destroy');
    
    // Admin Products Management (CRUD)
    Route::resource('admin/products', ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
});

require __DIR__.'/auth.php';
