<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/404', function () {
    abort(404);
});

Route::get('/', function () {
    return redirect()->route('woman.catalog');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/', function () {
        return view('profile.dashboard');
    })->name('dashboard');
    Route::get('orders/', [ProfileController::class, 'orders'])->name('orders.');
    Route::get('profile/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rendre ces routes uniquement accessibles à un admin
Route::middleware('auth')->group(function () {
    Route::prefix('manage/')->group(function () {
        Route::get('catalogs/', [ProductController::class, 'catalogs'])->name('catalogs.show');
        Route::get('men/catalog/', [ProductController::class, 'catalog'])->name('manage.men.catalog');
        Route::get('woman/catalog/', [ProductController::class, 'catalog'])->name('manage.woman.catalog');
        Route::put('add/product/', [ProductController::class, 'create'])->name('create.product');
        Route::patch('update/product/', [ProductController::class, 'update'])->name('update.product');
        Route::delete('delete/product/', [ProductController::class, 'destroy'])->name('destroy.product');
    });
});

Route::get('men/catalog', [ProductController::class, 'index'])->name('men.catalog');
Route::get('men/{slug}', [ProductController::class, 'show'])->name('men.product');
Route::get('woman/catalog', [ProductController::class, 'index'])->name('woman.catalog');
Route::get('woman/{slug}', [ProductController::class, 'show'])->name('woman.product');

Route::get('basket/', [BasketController::class, 'show'])->name('basket.show');
Route::put('basket/', [BasketController::class, 'store'])->name('basket.store');
Route::patch('basket/', [BasketController::class, 'update'])->name('basket.update');
Route::delete('basket/', [BasketController::class, 'destroy'])->name('basket.destroy');

Route::post('checkout/', [StripePaymentController::class, 'checkout'])->name('checkout');
Route::post('stripe_webhooks/', [StripePaymentController::class, 'webhooks'])->name('webhooks');


require __DIR__ . '/auth.php';
