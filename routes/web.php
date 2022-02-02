<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('products-update', [\App\Http\Controllers\ProductController::class, 'productUpdate'])->name('myproduct.update');
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::post('product-multi-delete/{id}', [\App\Http\Controllers\ProductController::class, 'delete_products'])->name('product-multi-delete');

require __DIR__.'/auth.php';
