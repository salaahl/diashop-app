<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\BrandController;
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

Route::get('/', [MainController::class, 'home'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/', function () {
        return view('profile.dashboard');
    })->name('dashboard');
    Route::get('orders/', [ProfileController::class, 'orders'])->name('orders.');
    Route::get('profile/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::prefix('manage/')->group(function () {
        Route::get('catalogs/', [ProductController::class, 'catalogs'])->name('catalogs.show');
        Route::get('men/catalog/', [ProductController::class, 'catalog'])->name('manage.men.catalog');
        Route::get('woman/catalog/', [ProductController::class, 'catalog'])->name('manage.woman.catalog');
        Route::get('add/product/', [ProductController::class, 'create'])->name('create.product');
        Route::post('add/product/', [ProductController::class, 'store'])->name('store.product');
        Route::patch('update/product/', [ProductController::class, 'update'])->name('update.product');
        Route::delete('delete/product/', [ProductController::class, 'destroy'])->name('destroy.product');
        Route::get('add/catalog/', [CatalogController::class, 'create'])->name('create.catalog');
        Route::post('add/catalog/', [CatalogController::class, 'store'])->name('store.catalog');
        Route::patch('update/catalog/', [CatalogController::class, 'update'])->name('update.catalog');
        Route::delete('delete/catalog/', [CatalogController::class, 'destroy'])->name('destroy.catalog');
        Route::get('add/category/', [CategoryController::class, 'create'])->name('create.category');
        Route::post('add/category/', [CategoryController::class, 'store'])->name('store.category');
        Route::patch('update/category/', [CategoryController::class, 'update'])->name('update.category');
        Route::delete('delete/category/', [CategoryController::class, 'destroy'])->name('destroy.category');
        Route::get('add/brand/', [BrandController::class, 'create'])->name('create.brand');
        Route::post('add/brand/', [BrandController::class, 'store'])->name('store.brand');
        Route::patch('update/brand/', [BrandController::class, 'update'])->name('update.brand');
        Route::delete('delete/brand/', [BrandController::class, 'destroy'])->name('destroy.brand');
        Route::get('add/option/', [OptionController::class, 'create'])->name('create.option');
        Route::post('add/option/', [OptionController::class, 'store'])->name('store.option');
        Route::patch('update/option/', [OptionController::class, 'update'])->name('update.option');
        Route::delete('delete/option/', [OptionController::class, 'destroy'])->name('destroy.option');
        Route::get('add/size/', [SizeController::class, 'create'])->name('create.size');
        Route::post('add/size/', [SizeController::class, 'store'])->name('store.size');
        Route::patch('update/size/', [SizeController::class, 'update'])->name('update.size');
        Route::delete('delete/size/', [SizeController::class, 'destroy'])->name('destroy.size');
    });
});

Route::get('men/catalog', [MainController::class, 'catalog'])->name('men.catalog');
Route::post('men/catalog', [MainController::class, 'catalog'])->name('men.catalog.post');
Route::get('men/{slug1}/{slug2}', [ProductController::class, 'show'])->name('men.product');
Route::get('woman/catalog', [MainController::class, 'catalog'])->name('woman.catalog');
Route::post('woman/catalog', [MainController::class, 'catalog'])->name('woman.catalog.post');
Route::get('woman/{slug1}/{slug2}', [ProductController::class, 'show'])->name('woman.product');
Route::post('get-quantity/', [ProductController::class, 'getQuantity'])->name('product.get-quantity');

Route::get('basket/', [BasketController::class, 'show'])->name('basket.show');
Route::put('basket/', [BasketController::class, 'store'])->name('basket.store');
Route::patch('basket/', [BasketController::class, 'update'])->name('basket.update');
Route::delete('basket/', [BasketController::class, 'destroy'])->name('basket.destroy');

Route::post('checkout/', [StripePaymentController::class, 'checkout'])->name('checkout');
Route::post('stripe_webhooks/', [StripePaymentController::class, 'webhooks'])->name('webhooks');

Route::get('contact-us/', [MainController::class, 'contactUs'])->name('contactus');
Route::get('about-me/', function () {
    return view('about-me');
});
Route::get('deliveries-and-returns/', function () {
    return view('deliveries-and-returns');
});
Route::get('refunds/', function () {
    return view('refunds');
});
Route::get('terms-and-conditions/', function () {
    return view('terms-and-conditions');
});

require __DIR__ . '/auth.php';
