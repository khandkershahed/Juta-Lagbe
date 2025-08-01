<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\BkashController;
use App\Http\Controllers\Frontend\StripeController;
use App\Http\Controllers\Admin\NewsletterController;

Route::middleware(['trackVisitor'])->group(function () {
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('privacy/policy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('terms-condition', [HomeController::class, 'termsCondition'])->name('termsCondition');
Route::get('faq', [HomeController::class, 'faq'])->name('faq');
Route::get('blogs', [HomeController::class, 'allBlog'])->name('allBlog');
Route::get('blog-details/{slug}', [HomeController::class, 'blogDetails'])->name('blog.details');
Route::get('about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('return-policy', [HomeController::class, 'returnPolicy'])->name('returnPolicy');
Route::get('category/{slug}', [HomeController::class, 'categoryProducts'])->name('category.products');
Route::get('product/details/{slug}', [HomeController::class, 'productDetails'])->name('product.details');

Route::post('contact/store', [ContactController::class, 'store'])->name('contact.add');
Route::post('email-subscription/store', [NewsletterController::class, 'store'])->name('subscription.add');
Route::get('/get-thanas-by-district/{districtName}', [HomeController::class, 'getThanasByDistrict']);
Route::get('/get-districts-by-division/{divisionName}', [HomeController::class, 'getDistrictsByDivision']);
Route::get('/get-charge-by-thana/{thanaName}', [HomeController::class, 'getShippingCahrgeByThana']);

// Cart routes
Route::get('mycart', [HomeController::class, 'cart'])->name('cart');
Route::get('buy-now/{id}', [HomeController::class, 'buyNow'])->name('buy.now');

Route::get('compare-list', [HomeController::class, 'compareList'])->name('compare.list');
Route::get('{slug}/products', [HomeController::class, 'specialproducts'])->name('special.products');
Route::get('checkout/success', [HomeController::class, 'checkoutSuccess'])->name('checkout.success');
Route::post('/cart/store/{id}', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('/comparelist/store/{id}', [CartController::class, 'compareList'])->name('compare.store');
Route::post('/wishlist/store/{id}', [CartController::class, 'wishListStore'])->name('wishlist.store');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/{id}/stripe/payment', [StripeController::class, 'stripePayment'])->name('stripe.payment');
Route::post('/stripe/pay', [StripeController::class, 'stripePost'])->name('stripe.pay');


// Checkout (URL) User Part
Route::get('/bkash-pay', [BkashController::class, 'payment'])->name('url-pay');
Route::post('/bkash-create', [BkashController::class, 'createPayment'])->name('url-create');
Route::get('/bkash-callback', [BkashController::class, 'callback'])->name('url-callback');

// Checkout (URL) Admin Part
Route::get('/bkash-refund', [BkashController::class, 'getRefund'])->name('url-get-refund');
Route::post('/bkash-refund', [BkashController::class, 'refundPayment'])->name('url-post-refund');
Route::get('/bkash-search', [BkashController::class, 'getSearchTransaction'])->name('url-get-search');
Route::post('/bkash-search', [BkashController::class, 'searchTransaction'])->name('url-post-search');
Route::get('/bkash-query/{paymentID}', [BkashController::class, 'queryPaymentAPI'])->name('url-get-query');

// Shop
Route::get('shop', [ShopController::class, 'allproducts'])->name('allproducts');
Route::get('/products/filter', [ShopController::class, 'filterProducts'])->name('products.filter');
Route::post('global-search', [HomeController::class, 'globalSearch'])->name('global.search');

Route::delete('wishlist/delete/{id}', [CartController::class, 'wishlistDestroy'])->name('wishlist.destroy');
Route::delete('cart/delete/{rowId}', [CartController::class, 'cartDestroy'])->name('cart.destroy');
Route::delete('cart/clear', [CartController::class, 'cartClear'])->name('cart.clear');
Route::post('cart/update', [CartController::class, 'updateCart'])->name('cart.update');
// Route::get('/filter-products', [filterProducts::class, 'filterProducts'])->name('filterProducts');

});

Route::post('checkout/store', [CartController::class, 'checkoutStore'])->name('checkout.store');
Route::group(['middleware' => ['web']], function () {
    Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'index'])->name('bkash.payment');
    Route::get('/bkash/create-payment/{order_number}', [App\Http\Controllers\BkashTokenizePaymentController::class,'createPayment'])->name('bkash.payment');
    Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');

});
