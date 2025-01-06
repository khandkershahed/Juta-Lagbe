<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\IconController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DealBannerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\PageBannerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\EmailSettingController;
use App\Http\Controllers\Admin\SpecialOfferController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Admin\StockManagementController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\TermsAndConditionController;
use App\Http\Controllers\Admin\ShippingManagementController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;

// Route::get('/', function () {
//     return redirect()->route('admin.dashboard');
// });

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('check-password', [PasswordController::class, 'checkPassword'])->name('checkPassword');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['verified'])->name('dashboard');

    Route::resources(
        [
            'faq-category'    => FaqCategoryController::class, //done
        ],
        ['except' => ['show', 'index', 'create', 'edit']]
    );
    Route::resources(
        [
            'blog-category'       => BlogCategoryController::class, //done
            'blog-tags'           => BlogTagController::class, //done
            'catalogue'           => CatalogueController::class, //done
            'shipping-management' => ShippingManagementController::class, //done
        ],
        ['except' => ['show', 'create', 'edit']]
    );
    Route::resources(
        [
            'faq'             => FaqController::class,
            'role'            => RoleController::class,
            'permission'      => PermissionController::class,
            'email-settings'  => EmailSettingController::class,
            'terms-condition' => TermsAndConditionController::class,
            'privacy-policy'  => PrivacyPolicyController::class,
            'deal-banner'     => DealBannerController::class,
            'blog-post'       => BlogPostController::class,
            'testimonial'     => TestimonialController::class,
            'product-review'  => ProductReviewController::class,
            'special-offer'   => SpecialOfferController::class,
        ],
        ['except' => ['show']]
    );
    Route::resources(
        [
            'user'                  => UserController::class, //done
            'staff'                 => StaffController::class, //done
            'user-management'       => UserManagementController::class, //done
            'admin-managemnet'      => AdminManagementController::class, //done
            'categories'            => CategoryController::class, //done
            'icons'                 => IconController::class, //done
            'newsletters'           => NewsletterController::class,
            'brands'                => BrandController::class, //done
            'contacts'              => ContactController::class,
            'product'               => ProductController::class,
            'banner'                => PageBannerController::class,
        ],
    );

    Route::controller(StockManagementController::class)->group(function () {
        Route::get('/stock-management', 'index')->name('stock-management.index');
        Route::put('/stock/update/{id}', 'stockUpdate')->name('stock.update');
    });
    // Route::controller(ShippingManagementController::class)->group(function () {
    //     Route::get('/shipping-management', 'index')->name('shipping-management.index');
    // });
    Route::controller(OrderManagementController::class)->group(function () {
        Route::get('/order-management', 'index')->name('order-management.index');
        Route::get('/order/{id}/details', 'orderDetails')->name('orderDetails');
        Route::get('/order/report', 'orderReport')->name('orderReport');
        Route::put('/order/update/{id}', 'statusUpdate')->name('order.update');

    });

    Route::get('active-mail-configuration', [EmailSettingController::class, 'activeMailConfiguration'])->name('active.mail.configuration');
    Route::put('email-settings', [EmailSettingController::class, 'emailUpdateOrCreate'])->name('email.settings.updateOrCreate');
    Route::post('send-test-mail', [EmailSettingController::class, 'sendTestMail'])->name('send.test.mail');

    Route::post('email-settings/toggle-status/{id}', [EmailSettingController::class, 'toggleStatus'])->name('email-settings.toggle-status');

    Route::post('icons/toggle-status/{id}', [IconController::class, 'toggleStatus'])->name('icons.toggle-status');
    Route::post('brands/toggle-status/{id}', [BrandController::class, 'toggleStatus'])->name('brands.toggle-status');
    Route::post('categories/toggle-status/{id}', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
    Route::post('banner/toggle-status/{id}', [PageBannerController::class, 'toggleStatus'])->name('banner.toggle-status');
    Route::post('testimonial/toggle-status/{id}', [TestimonialController::class, 'toggleStatus'])->name('testimonial.toggle-status');
    Route::post('deal-banner/toggle-status/{id}', [DealBannerController::class, 'toggleStatus'])->name('deal-banner.toggle-status');
    Route::post('product/toggle-status/{id}', [BrandController::class, 'toggleStatus'])->name('product.toggle-status');
    Route::post('user/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('user.toggle-status');
    // Route::post('services/toggle-status/{id}', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');

    Route::get('/backup', [Controller::class, 'downloadBackup']);

    Route::get('role/{roleId}/give-permission', [RoleController::class, 'givePermission'])->name('role.give-permission');
    Route::patch('role/{roleId}/give-permission', [RoleController::class, 'storePermission'])->name('role.store-permission');

    Route::get('log', [LogController::class, 'index'])->name('log.index');
    Route::get('log/{id}', [LogController::class, 'show'])->name('log.show');
    Route::delete('log/{id}', [LogController::class, 'destroy'])->name('log.destroy');
    Route::delete('multiimage/{id}', [ProductController::class, 'multiImageDestroy'])->name('multiimage.destroy');
    Route::get('log/download/{id}', [LogController::class, 'download'])->name('log.download');

    Route::get('activity_logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');
    Route::get('activity_logs/{activity_log}', [ActivityLogController::class, 'show'])->name('activity_logs.show');
    Route::delete('activity_logs/{activity_log}', [ActivityLogController::class, 'destroy'])->name('activity_logs.destroy');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'updateOrcreateSetting'])->name('settings.updateOrCreate');

    // Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
    // Route::put('/banner', [BannerController::class, 'updateOrcreateBanner'])->name('banner.updateOrCreate');

    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::put('/about-us', [AboutUsController::class, 'updateOrcreateAboutUs'])->name('about-us.updateOrCreate');

    // Bulk Delete
    // web.php
    Route::post('/categories/bulk-delete', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');
});
