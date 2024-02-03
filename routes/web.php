<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
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
    return view('home');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/', function () {
        return view('profile.dashboard');
    })->name('dashboard');

    Route::get('profile/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile/', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('favorites/', [FavoriteController::class, 'show'])->name('favorites.show');
    Route::put('favorites/add', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/remove', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::get('orders/', [ProfileController::class, 'orders'])->name('orders.');
});

Route::middleware(['auth', 'is.admin'])->group(function () {
    Route::prefix('administrator')->group(function () {
        Route::get('/', function () {
            return view('administrator.dashboard');
        })->name('administrator.dashboard');
        Route::get('/show/catalogs/', [CatalogController::class, 'show'])->name('administrator.show.catalogs');
        Route::post('/show/catalogs/', [CatalogController::class, 'show'])->name('administrator.show.catalogs.post');
        Route::get('/show/categories/', [CategoryController::class, 'show'])->name('administrator.show.categories');
        Route::post('/show/categories/', [CategoryController::class, 'show'])->name('administrator.show.categories.post');
        Route::post('/get-categories/', [CategoryController::class, 'getCategories'])->name('administrator.get-categories');
        Route::get('/show/products/', [ProductController::class, 'show'])->name('administrator.show.products');
        Route::post('/show/products/', [ProductController::class, 'show'])->name('administrator.show.products.post');

        Route::get('/add/catalog/', [CatalogController::class, 'create'])->name('create.catalog');
        Route::post('/add/catalog/', [CatalogController::class, 'store'])->name('store.catalog');
        Route::get('/edit/catalog/{catalog_id}', [CatalogController::class, 'edit'])->name('edit.catalog');
        Route::post('/update/catalog/{catalog_id}', [CatalogController::class, 'update'])->name('update.catalog');
        Route::post('/delete/catalog/{catalog_id}', [CatalogController::class, 'destroy'])->name('destroy.catalog');

        Route::get('/add/category/', [CategoryController::class, 'create'])->name('create.category');
        Route::post('/add/category/', [CategoryController::class, 'store'])->name('store.category');
        Route::get('/edit/category/{category_id}', [CategoryController::class, 'edit'])->name('edit.category');
        Route::post('/update/category/{category_id}', [CategoryController::class, 'update'])->name('update.category');
        Route::post('/delete/category/{category_id}', [CategoryController::class, 'destroy'])->name('destroy.category');

        Route::get('/add/product/', [ProductController::class, 'create'])->name('create.product');
        Route::post('/add/product/', [ProductController::class, 'store'])->name('store.product');
        Route::get('/edit/product/{product_id}', [ProductController::class, 'edit'])->name('edit.product');
        Route::post('/update/product/{product_id}', [ProductController::class, 'update'])->name('update.product');
        Route::post('/delete/product/{product_id}', [ProductController::class, 'destroy'])->name('destroy.product');
    });
});

Route::get('search/{query?}', [MainController::class, 'search'])->name('search.product');
Route::post('search/', [MainController::class, 'searchAsync'])->name('search.product.async');

Route::get('men/catalog', [MainController::class, 'catalog'])->name('men.catalog');
Route::post('men/catalog', [MainController::class, 'catalog'])->name('men.catalog.post');
Route::get('men/catalog/{category}', [MainController::class, 'category'])->name('men.category');
Route::post('men/catalog/{category}', [MainController::class, 'category'])->name('men.category.post');
Route::get('men/catalog/{category}/{product_id}', [MainController::class, 'product'])->name('men.product');

Route::get('woman/catalog', [MainController::class, 'catalog'])->name('woman.catalog');
Route::post('woman/catalog', [MainController::class, 'catalog'])->name('woman.catalog.post');
Route::get('woman/catalog/{category}', [MainController::class, 'category'])->name('woman.category');
Route::post('woman/catalog/{category}', [MainController::class, 'category'])->name('woman.category.post');
Route::get('woman/catalog/{category}/{product_id}', [MainController::class, 'product'])->name('woman.product');
Route::post('get-quantity/', [ProductController::class, 'getQuantity'])->name('product.get-quantity');

Route::get('basket/', [BasketController::class, 'show'])->name('basket.show');
Route::put('basket/store', [BasketController::class, 'store'])->name('basket.store');
Route::patch('basket/update', [BasketController::class, 'update'])->name('basket.update');
Route::delete('basket/remove', [BasketController::class, 'remove'])->name('basket.remove');
// Remettre en "delete" à la fin de mes tests
Route::get('basket/destroy', [BasketController::class, 'destroy'])->name('basket.destroy');

Route::get('checkout/', function () {
    return view('stripe/checkout');
})->name('checkout.show');
Route::post('checkout/', [StripePaymentController::class, 'checkout'])->name('checkout.post');
Route::get('return/{slug}',  function () {
    return view('stripe/return');
})->name('return.show');
Route::post('status/', [StripePaymentController::class, 'status'])->name('status.post');
Route::post('webhooks/', [StripePaymentController::class, 'webhooks'])->name('webhooks');

Route::get('contact-us/', [MainController::class, 'contactUs'])->name('contact-us');
Route::get('about-me/', function () {
    return view('about-me');
})->name('about-me');
Route::get('deliveries-and-returns/', function () {
    return view('deliveries-and-returns');
})->name('deliveries-and-returns');
Route::get('terms-and-conditions/', function () {
    return view('terms-and-conditions');
});

require __DIR__ . '/auth.php';
