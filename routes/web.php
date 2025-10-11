<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\StripeWebhookController;
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

Route::get('/', [ProductController::class, 'home'])->name('home');

// Voyager implémente déjà un middleware pour le role admin
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth', 'decode.json']], function () {
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

Route::get('search/{catalog}/{input}', [ProductController::class, 'search'])->name('search.product');
Route::post('search/{catalog}/{input}', [ProductController::class, 'search'])->name('search.product.post');
Route::post('search/', [ProductController::class, 'searchAsync'])->name('search.product.async');

Route::get('catalog/{catalog}/', [ProductController::class, 'catalog'])->name('catalog');
Route::post('catalog/{catalog}/', [ProductController::class, 'catalog'])->name('catalog.post');
Route::get('catalog/{catalog}/{category}', [ProductController::class, 'category'])->name('category');
Route::post('catalog/{catalog}/{category}', [ProductController::class, 'category'])->name('category.post');
Route::get('catalog/{catalog}/{category}/{product_id}', [ProductController::class, 'product'])->name('product');
Route::post('/get-stock', [ProductController::class, 'productStock'])->name('product.get-stock');

Route::put('basket/store', [BasketController::class, 'store'])->name('basket.store');
Route::delete('basket/remove', [BasketController::class, 'remove'])->name('basket.remove');
Route::delete('basket/destroy', [BasketController::class, 'destroy'])->name('basket.destroy');

Route::get('checkout/', [StripePaymentController::class, 'checkout'])->name('checkout');
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
Route::get('confirmation/{slug}', [StripePaymentController::class, 'confirmation'])->name('confirmation.show');

Route::get('about-us/', function () {
    return view('about-us');
})->name('about-us');
Route::get('legal-notice/', function () {
    return view('legal-notice');
})->name('legal-notice');
Route::get('terms-of-sales/', function () {
    return view('terms-of-sales');
})->name('terms-of-sales');

require __DIR__ . '/auth.php';
