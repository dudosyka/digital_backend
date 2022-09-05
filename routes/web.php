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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::post('/auth', [ \App\Http\Controllers\UserController::class, 'auth' ]);
Route::post('/signup', [  \App\Http\Controllers\UserController::class, 'signup' ]);

Route::post('/products', [ \App\Http\Controllers\ProductController::class, 'getAll' ]);
Route::post('/product', [ \App\Http\Controllers\ProductController::class, 'getOne' ]);
Route::post('/product/category', [ \App\Http\Controllers\ProductController::class, 'getByCategory' ]);
Route::post('/product/remove', [ \App\Http\Controllers\ProductController::class, 'removeProduct' ])->middleware(\App\Http\Middleware\Auth::class);
Route::post('/product/update', [ \App\Http\Controllers\ProductController::class, 'updateProduct' ])->middleware(\App\Http\Middleware\Auth::class);

Route::post('/cart/add', [ \App\Http\Controllers\CartController::class, 'addProduct' ])->middleware(\App\Http\Middleware\Auth::class);
Route::post('/cart/remove', [ \App\Http\Controllers\CartController::class, 'removeProducts' ])->middleware(\App\Http\Middleware\Auth::class);

Route::post('/order/create', [ \App\Http\Controllers\OrderController::class, 'createOrder' ])->middleware(\App\Http\Middleware\Auth::class);
Route::post('/orders', [ \App\Http\Controllers\OrderController::class, 'getOrders' ])->middleware(\App\Http\Middleware\Auth::class);
Route::post('/order', [ \App\Http\Controllers\OrderController::class, 'getOrder' ])->middleware(\App\Http\Middleware\Auth::class);
Route::post('/order/remove', [ \App\Http\Controllers\OrderController::class, 'remove' ])->middleware(\App\Http\Middleware\Auth::class);
Route::post('/order/status', [ \App\Http\Controllers\OrderController::class, 'changeStatus' ])->middleware(\App\Http\Middleware\Auth::class);

Route::post('/categories', [ \App\Http\Controllers\CategoryController::class, 'getAll'])->middleware(\App\Http\Middleware\Auth::class);;
Route::post('/category/create', [ \App\Http\Controllers\CategoryController::class, 'create'])->middleware(\App\Http\Middleware\Auth::class);
Route::post('/category/remove', [ \App\Http\Controllers\CategoryController::class, 'remove'])->middleware(\App\Http\Middleware\Auth::class);

//Route::post('/profile', [ \App\Http\Controllers\UserController::class, 'profile' ])
