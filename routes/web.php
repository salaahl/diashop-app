<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\StripePaymentController;
use TCG\Voyager\Facades\Voyager;
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
})->name('404');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard/', function () {
        return view('profile.dashboard');
    })->name('dashboard');

    Route::get('profile/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('favorites/', [FavoriteController::class, 'show'])->name('favorites');
    Route::put('favorites/add', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/remove', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::get('orders/', [ProfileController::class, 'orders'])->name('orders');
});

Route::get('search/{catalog}/{input}', [MainController::class, 'search'])->name('search.product');
Route::post('search/', [MainController::class, 'searchAsync'])->name('search.product.async');

Route::get('catalog/{catalog}/', [MainController::class, 'catalog'])->name('catalog');
Route::post('catalog/{catalog}/', [MainController::class, 'catalog'])->name('catalog.post');
Route::get('catalog/{catalog}/{category}', [MainController::class, 'category'])->name('category');
Route::post('catalog/{catalog}/{category}', [MainController::class, 'category'])->name('category.post');
Route::get('catalog/{catalog}/{category}/{product_id}', [MainController::class, 'product'])->name('product');

Route::post('get-quantity/', [ProductController::class, 'getQuantity'])->name('product.get-quantity');

Route::put('basket/store', [BasketController::class, 'store'])->name('basket.store');
Route::delete('basket/remove', [BasketController::class, 'remove'])->name('basket.remove');
Route::delete('basket/destroy', [BasketController::class, 'destroy'])->name('basket.destroy');

Route::get('checkout/', function () {
    return view('stripe/checkout');
})->name('checkout.show');
Route::post('checkout/', [StripePaymentController::class, 'checkout'])->name('checkout.post');
Route::get('confirmation/{slug}', [StripePaymentController::class, 'confirmation'])->name('confirmation.show');

Route::get('about-me/', function () {
    return view('about-me');
})->name('about-me');
Route::get('legal-notice/', function () {
    return view('legal-notice');
})->name('legal-notice');
Route::get('terms-of-sales/', function () {
    return view('terms-of-sales');
})->name('terms-of-sales');

require __DIR__ . '/auth.php';
