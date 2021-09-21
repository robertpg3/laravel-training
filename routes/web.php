<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientProductController;
use \App\Http\Controllers\PaymentController;
use App\Http\Controllers\ClientOrderController;

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

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'indexRegister']);
Route::post('/register', [LoginController::class, 'register']);
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm']);
Route::get('/change-password', [LoginController::class, 'resetPassword']);
Route::post('/forgot-password', [LoginController::class, 'sendPasswordMail'])->name('password.email');
Route::post('/change-password', [LoginController::class, 'changePassword']);
Route::post('/reset-password-action', [LoginController::class, 'recoverNewPassword'])->name('password.update');
Route::get('/reset-password/{token}', [LoginController::class, 'recoverNewPasswordForm'])->name('password.reset');
Route::get('/confirm-register', [LoginController::class, 'confirmRegister'])->name('verification.verify');

Route::prefix('admin')->group(function() {
    Route::middleware(['myMiddleware'])->group(function() {
        Route::get('/products', [ProductController::class, 'index'])->name('shop.products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('shop.products.create');
        Route::post('/products/create', [ProductController::class, 'store'])->name('shop.products.store');
        Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('shop.products.edit');
        Route::put('/products/edit/{id}', [ProductController::class, 'update'])->name('shop.products.update');
        Route::get('/products/remove/{id}', [ProductController::class, 'destroy'])->name('shop.products.destroy');
        Route::get('/categories', [CategoryController::class, 'index'])->name('shop.categories');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('shop.categories.create');
        Route::post('/categories/create', [CategoryController::class, 'store'])->name('shop.categories.store');
        Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('shop.categories.edit');
        Route::put('/categories/edit/{id}', [CategoryController::class, 'update'])->name('shop.categories.update');
        Route::get('/categories/remove/{id}', [CategoryController::class, 'destroy'])->name('shop.categories.destroy');
        Route::get('/orders', [OrdersController::class, 'index'])->name('shop.orders');
        Route::get('/orders/create', [OrdersController::class, 'create'])->name('shop.orders.create');
        Route::post('/orders/create', [OrdersController::class, 'store'])->name('shop.orders.store');
        Route::get('/users', [UsersController::class, 'index'])->name('shop.users');
        Route::get('/users/create', [UsersController::class, 'create'])->name('shop.users.create');
        Route::post('/users/create', [UsersController::class, 'store'])->name('shop.users.store');
        Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('shop.users.edit');
        Route::put('/users/edit/{id}', [UsersController::class, 'update'])->name('shop.users.update');
        Route::get('/users/remove/{id}', [UsersController::class, 'destroy'])->name('shop.users.destroy');
    });
});

Route::get('/products', [ClientProductController::class, 'index'])->name('products');
Route::get('/product-details/{id}', [ClientProductController::class, 'show'])->name('product');
Route::get('/add-to-cart/{id}', [ClientProductController::class, 'addToCart'])->name('add.cart');
Route::get('/cart', [ClientProductController::class, 'showCart'])->name('cart');
Route::get('/cart/proceed', [PaymentController::class, 'showPayment'])->name('payment');
Route::post('/v1/webhook_endpoints', [PaymentController::class, 'checkout']);
Route::get('/success', [PaymentController::class, 'showSuccess']);
Route::get('/error', [PaymentController::class, 'showError']);
Route::get('/order-history', [ClientOrderController::class, 'index']);
Route::get('/order-history/export/{id}', [ClientOrderController::class, 'exportPDF']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/wire', [ClientProductController::class, 'testWire']);
