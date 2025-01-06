<?php

use App\Http\Controllers\User\ClientController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('order/history/', [ClientController::class, 'orderHistory'])->name('order.history');
    Route::get('order/tracking/', [ClientController::class, 'orderTracking'])->name('order.tracking');
    Route::get('account/details/', [ClientController::class, 'accountDetails'])->name('account.details');
    Route::get('quick/order/', [ClientController::class, 'quickOrder'])->name('quick.order');
    Route::get('stock/history/', [ClientController::class, 'stockHistory'])->name('stock.history');
    Route::get('product/data/', [ClientController::class, 'productData'])->name('product.data');
    Route::get('view/catalouge/', [ClientController::class, 'viewCatalouge'])->name('view.catalouge');
    Route::get('wishlist', [ClientController::class, 'wishlist'])->name('wishlist');
});
