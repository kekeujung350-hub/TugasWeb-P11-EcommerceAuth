<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/* ---------- Publik ---------- */
Route::redirect('/', '/products');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/demo/eager-loading', [ProductController::class, 'eagerDemo'])->name('products.eager-demo');

/* ---------- Harus login ---------- */
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Semua user login boleh MELIHAT daftar post
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    // Hanya admin & editor yang boleh kelola post (lapis 1: role middleware, lapis 2: PostPolicy)
    Route::middleware('role:admin,editor')->group(function () {
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
});

/* ---------- Khusus admin ---------- */
Route::middleware(['auth', 'role:admin'])->prefix('manage')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard', [
        'users' => User::count(),
        'products' => Product::count(),
        'orders' => Order::count(),
        'posts' => Post::count(),
    ]))->name('dashboard');
});

require __DIR__.'/auth.php';
