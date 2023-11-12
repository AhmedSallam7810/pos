<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route ;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){

        Route::get('/index',[DashboardController::class,'index'])->name('index');


        Route::resource('categories',CategoryController::class);

        Route::resource('products',ProductController::class);
    
        Route::resource('clients',ClientController::class);

        Route::resource('clients.orders',ClientOrderController::class);

        Route::resource('orders',OrderController::class);
        Route::get('/orders/{order}/products', [OrderController::class,'products'])->name('orders.products');


        Route::resource('users',UserController::class);

    });

});