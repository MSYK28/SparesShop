<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SuppliersController;
use App\Models\Analytics;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// PRODUCTS ROUTE
Route::resource('/products', ProductsController::class);
Route::post('/products/import-csv', [ProductsController::class, 'importCSV'])->name('products.import-csv');
Route::post('/products/import-xls', [ProductsController::class, 'importXLS'])->name('products.import-xls');

// CART ROUTES
Route::post('/products/add-to-cart', [HomeController::class, 'addToCart'])->name('products.add-to-cart');
Route::delete('/products/remove-from-cart/{id}', [HomeController::class, 'removeFromCart'])->name('products.remove-from-cart');
Route::delete('/products/cart/empty', [HomeController::class, 'emptyCart'])->name('products.empty-cart');
Route::get('/products/cart/total', [HomeController::class, 'getCartTotal'])->name('products.cart-total');
Route::post('/products/cart/purchase', [HomeController::class, 'purchase'])->name('products.purchase');
Route::post('/products/cart/store', [HomeController::class, 'store'])->name('cart.store');

// SALES ROUTE
Route::resource('/sales', SalesController::class);
Route::get('/sales/receipt/{id}', [SalesController::class, 'printReceipt'])->name('sales.receipt');


// CUSTOMERS ROUTE
Route::resource('/customers', CustomersController::class);
Route::get('/customers/show-customer-details/{id}', [CustomersController::class, 'showCustomerInfo'])->name('customers.show-customer-details');
Route::post('/customers/transactions', [CustomersController::class, 'transactions'])->name('customers.transactions');


// SUPPLIERS ROUTE
Route::resource('/suppliers', SuppliersController::class);
Route::post('/suppliers/transaction', [SuppliersController::class, 'transaction'])->name('suppliers.transact');


// ORDERS ROUTE
Route::resource('/orders', OrdersController::class);
Route::get('/orders/create-order/{id}', [OrdersController::class, 'createOrder'])->name('orders.createOrder');
Route::post('/orders/add-to-basket', [OrdersController::class, 'addToBasket'])->name('orders.add-to-basket');
Route::delete('/orders/basket/empty', [OrdersController::class, 'emptyBasket'])->name('orders.empty-basket');
Route::post('/orders/basket/purchase', [OrdersController::class, 'purchase'])->name('orders.purchase');

Route::get('/orders/products/supplier/{id}', [OrdersController::class, 'getProductsBySupplier'])->name('orders.get-products');
Route::get('/orders/products/below-reorder-level/{id}', [OrdersController::class, 'getProductsBelowReorderLevel'])->name('orders.products-below-reorder');

// ANALYTICS ROUTE
Route::resource('/analytics', AnalyticsController::class)->middleware('auth');
Route::post('/analytics/check-password', [AnalyticsController::class, 'checkPassword'])->name('analytics.check-password');