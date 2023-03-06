<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['web', 'auth'])->prefix('dashboard')->group(function () {

    Route::resource('/users', App\Http\Controllers\UserController::class);
    Route::resource('/categories', App\Http\Controllers\CategoriesController::class);


    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create/', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [App\Http\Controllers\CategoriesController::class, 'create'])->name('categories.create');
    Route::get('/categories/{categories}/edit', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('categories.edit');
    Route::get('/categories/{categories}', [App\Http\Controllers\CategoriesController::class, 'update'])->name('categories.update');


    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/addgallery/{product}', [App\Http\Controllers\ProductController::class, 'gallery'])->name('products.gallery');
    Route::post('/products/addgallery/{product}', [App\Http\Controllers\ProductController::class, 'storeImage'])->name('products.store.image');

    Route::resource('/products', App\Http\Controllers\ProductController::class);

});

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::get('/test-route', [App\Http\Controllers\ProductController::class, 'index'])->middleware('check.role:Editor');

