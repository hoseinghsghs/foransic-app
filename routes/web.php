<?php

use App\Events\NotificationMessage;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SmsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Home\AddressController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\CommentController as HomeCommentController;
use App\Http\Controllers\Home\CompareController;
use App\Http\Controllers\Home\FaqController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Home\PostController as HomePostController;
use App\Http\Controllers\Home\DeviceController as HomeDeviceController;
use App\Http\Controllers\Home\QuestionController as HomeQuestionController;
use App\Http\Controllers\Home\UserProfileController;
use App\Http\Controllers\Home\WishListController;
use App\Http\Livewire\Admin\Keywords\KeywordControll;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Tags\TagControll;
use App\Livewire\Admin\Actions\ActionControll;
use App\Http\Livewire\Home\Cart\ShowCart;
use App\Livewire\Home\DevicesList;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Facades\SEOMeta;

//fortify routes
require_once __DIR__ . '/fortify.php';
//admin routes
Route::prefix('Admin-panel/managment')->name('admin.')->middleware(['auth','has_role'])->group(function () {
    Route::get('/timeline', [EventController::class, 'index'])->name('timeline')->middleware('permission:events');
    Route::delete('/timeline/{event}', [EventController::class, 'destroy'])->name('timeline.destroy')->middleware('permission:events');
    Route::resource('galeries',         GaleryController::class)->middleware('permission:galeries');
    Route::get('devices/{device}/edit', \App\Livewire\Admin\Devices\EditDevice::class)->middleware('permission:devices')->name('devices.edit');

    Route::get('devices/create', \App\Livewire\Admin\Devices\CreateDevice::class)->middleware('permission:devices')->name('devices.create');
    Route::resource('devices',         DeviceController::class)->middleware('permission:devices')->only(['index', 'show']);
    Route::get('archives',         [DeviceController::class, 'archive'])->name('archive')->middleware('permission:devices');
    Route::resource('users',            UserController::class)->except('create', 'destroy')->middleware('permission:users');
    Route::resource('roles',   RoleController::class)->except('show')->middleware('permission:roles');
    Route::post('/sms/send-sms',   [SmsController::class,'sendSms'])->name('sms.sendSms')->middleware('permission:sms');
    Route::resource('sms',   SmsController::class)->only('create','store')->middleware('permission:sms');
    Route::view('permissions', 'admin.page.permissions.index')->name('permissions')->middleware('permission:permissions');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::view('/user/password', 'admin.page.auth.change-password')->name('profile.change-pass');
    Route::view('/settings', 'admin.page.settings.setting')->name('settings.show')->middleware('permission:settings');
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('actions/{device}/create',  \App\Livewire\Admin\Actions\ActionControll::class)->name('actions.create')->middleware('permission:actions');
    // Route::resource('brands',         BrandController::class)->middleware('permission:brands');
    // Route::resource('attributes',     AttributeController::class)->except(['show', 'destroy'])->middleware('permission:attributes');
    // Route::post('/categories/order', [CategoryController::class, 'saveOrder'])->name('category.order');
    // Route::resource('categories',       CategoryController::class)->except(['destroy', 'show'])->middleware('permission:categories');
    // Route::resource('banners',          BannerController::class)->except(['show', 'destroy'])->middleware('permission:banners');
    // Route::resource('services',         ServiceController::class)->except(['show'])->middleware('permission:services');
    // Route::resource('posts',            PostController::class)->except('show')->middleware('permission:posts');
    // Route::resource('comments',         CommentController::class)->middleware('permission:comments');
    // Route::resource('questions',         QuestionController::class)->middleware('permission:questions');
    // Route::resource('coupons',          CouponController::class)->middleware('permission:coupons');
    // Route::resource('orders',           OrderController::class)->middleware('permission:orders');
    // Route::resource('transactions',     TransactionController::class)->middleware('permission:transactions');
    // Route::get('analytics',         [AnalyticsController::class, 'show'])->name('analytics.show')->middleware('permission:analytics');
    // Route::get('prices',     [PriceController::class, 'index'])->name('prices.index')->middleware('permission:prices');
    // Route::post('prices',     [PriceController::class, 'update'])->name('prices.update')->middleware('permission:prices');
    //ویرایش دسته ای
    // Route::post('base-prices',     [PriceController::class, 'updatebaseprice'])->name('prices.baseupdate')->middleware('permission:prices');
    // Route::post('update-guarantee',     [PriceController::class, 'updateGuarantee'])->name('updateguarantee')->middleware('permission:guarantee');
    // Route::post('update-delivery',     [PriceController::class, 'updateDelivery'])->name('updatedelivery')->middleware('permission:delivery');

    // Route::get('keywords/create',                         [KeywordControll::class, "createKeyword"])->name('keywords.create')->middleware('permission:keywords');
    // Route::get('/category-attributes/{category}',     [CategoryController::class, 'getCategoryAttributes']);
    Route::get('/devices/{device}/images-edit',     [ImageController::class, 'edit'])->name('devices.images.edit');

    // // Edit Device Category
    // Route::get('/devices/{device}/category-edit',   [DeviceController::class, 'editCategory'])->name('devices.category.edit');
    // Route::put('/devices/{device}/category-update', [DeviceController::class, 'updateCategory'])->name('devices.category.update');

    //image routes
    Route::post('/upl',       [DeviceController::class, 'uploadImage'])->name('uploade');
    Route::post('/del',       [DeviceController::class, 'deleteImage'])->name('del');
    Route::post('/editupl',   [ImageController::class, 'edit_uploadImage'])->name('edit_uploade');
    Route::post('/editdel',   [ImageController::class, 'edit_deleteImage'])->name('edit_del');
    Route::post('/add_image', [ImageController::class, 'setPrimary'])->name('device.images.add');

    //excel backup
    Route::get('/export-Device', [BackupController::class, 'ExportDevices'])->name('file-device');
    Route::get('/export-Device2', [BackupController::class, 'ExportDevices2'])->name('file-device2');
    Route::get('/export-UserAddress', [BackupController::class, 'ExportUserAddresses'])->name('file-address');
    Route::get('/export-Transactions', [BackupController::class, 'TransactionExport'])->name('file-transactions');
    Route::get('/export-Users', [BackupController::class, 'ExportUsers'])->name('file-users');
    Route::get('/export-Orders', [BackupController::class, 'ExportOrders'])->name('file-orders');

    //Multi-vendor
    // Route::resource('shop',   ShopController::class)->except('show')->middleware('permission:roles');
});
//end

//admin auth
// Route::view('admin/login', 'admin.page.auth.login')->middleware('guest')->name('admin.login');

// home routes
// Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');

// Route::get('/devices/{device:slug}', [HomeDeviceController::class, 'show'])->name('home.devices.show');

// Route::get('/search/{slug?}', DevicesList::class)->name('home.devices.search');
// Route::get('/main/{slug}', DevicesList::class)->name('home.devices.index');

// //comments
// Route::get('home/question/{device}', [HomeCommentController::class, 'create'])->name('home.comments.index');
// Route::post('/comments/{device}', [HomeCommentController::class, 'store'])->name('home.comments.store');
// Route::post('/reply/store', [HomeCommentController::class, 'replyStore'])->name('reply.add');
// Route::post('/postcomments/{post}', [HomeCommentController::class, 'poststore'])->name('home.comments.poststore');

// //questions
// Route::post('/question/{device}', [HomeQuestionController::class, 'store'])->name('home.questions.store');
// Route::post('/question/reply/store', [HomeQuestionController::class, 'replyStore'])->name('questions.reply.add');

// otp auth
Route::post('/auth/check', [OtpController::class, 'authenticate'])->name('authenticate');
Route::post('/otp/verify', [OtpController::class, 'checkVerificationCode'])->name('otp.verify');
Route::post('/otp/resend', [OtpController::class, 'resendVerificationCode'])->name('otp.resend');
Route::post('/otp/reset-password', [OtpController::class, 'resetPassword'])->name('otp.resetPassword');
Route::post('/otp/alter-phone', [OtpController::class, 'alterPhone'])->middleware('auth')->name('phone.update');
Route::post('/otp/verfiy-phone', [OtpController::class, 'verfiyPhone'])->middleware('auth')->name('phone.verify');
// end otp auth

Route::get('/assets/ajax', function () {
    return view('home.partial.login');
});

// Route::prefix('profile')->name('home.')->middleware(['auth'])->group(function () {
//     Route::get('/', [UserProfileController::class, 'index'])->name('user_profile');
//     Route::get('/editProfile', [UserProfileController::class, 'editProfile'])->name('user_profile.edit');
//     //    Route::post('/forgot-password', [UserProfileController::class, 'forgetPassword'])->name('password.email');
//     Route::get('/wishlist', [WishListController::class, 'usersProfileIndex'])->name('profile.wishlist.index');
//     Route::get('/add-to-wishlist/{device:id}', [WishListController::class, 'add'])->name('home.wishlist.add');
//     Route::get('/addreses',  [AddressController::class, 'index'])->name('addreses.index');
//     Route::get('/addreses/create',  [AddressController::class, 'create'])->name('addreses.create');
//     Route::post('/addreses', [AddressController::class, 'store'])->name('addreses.store');
//     Route::get('/addreses/{address}', [AddressController::class, 'edit'])->name('addreses.edit');
//     Route::put('/addreses/{address}', [AddressController::class, 'update'])->name('addreses.update');
//     Route::get('/addreses/delete/{address}', [AddressController::class, 'destroy'])->name('addreses.destroy');
//     Route::get('/orders', [UserProfileController::class, 'orderList'])->name('user_profile.ordersList');
//     Route::get('/orders/{order}', [UserProfileController::class, 'order'])->name('user_profile.orders');
//     Route::get('/commentsList', [UserProfileController::class, 'commentsList'])->name('user_profile.commentsList');
// });

//user route
// Route::get('/add-to-compare/{device:id}', [CompareController::class, 'add'])->name('home.compare.add');

// Route::get('/compare', [CompareController::class, 'index'])->name('home.compare.index');
// Route::get('/remove-from-compare/{device}', [CompareController::class, 'remove'])->name('home.compare.remove');

// //cart
// Route::post('/add-to-cart', [CartController::class, 'add'])->name('home.cart.add');

// Route::get('/cart', ShowCart::class)->name('home.cart.index');

// Route::get('/remove-from-cart/{rowId}', [CartController::class, 'remove'])->name('home.cart.remove');

// Route::get('/checkout', [CartController::class, 'checkout'])->name('home.orders.checkout')->middleware('auth');

// Route::post('/payment', [PaymentController::class, 'payment'])->name('home.payment');

// Route::get('/post/{post:slug}', [HomePostController::class, 'show'])->name('home.posts.show');
// Route::get('/post', [HomePostController::class, 'index'])->name('home.posts.index');


// Route::get('/post/list/{post:category}', [HomePostController::class, 'list'])->name('home.posts.list');

// Route::get('/payment-verify/{gatewayName}', [PaymentController::class, 'paymentVerify'])->name('home.payment_verify');
// Route::post('/payment-verify-mellat', [PaymentController::class, 'paymentVerifyMellat'])->name('home.payment_verifyMellat');

// Route::get('/get-province-cities-list', [AddressController::class, 'getProvinceCitiesList']);

// //coupon
// Route::post('/checkcoupon', [PaymentController::class, 'checkCoupon'])->name('home.orders.checkcoupon')->middleware('auth');
// // change transport
// Route::post('/change-transport', [PaymentController::class, 'changeTransport'])->middleware('auth');
// //faq
// Route::get('/faq', [FaqController::class, 'index'])->name('faq');
// Route::get('/privacy', [FaqController::class, 'privacy'])->name('privacy');
// Route::get('/rules', [FaqController::class, 'rules'])->name('ruls');

// Route::get('/image_manipulation/{name}', [ImageController::class, 'flyManipulation'])->name('fly-manipulation');
// Route::get('/postimg', [PostController::class, 'PostIMG'])->name('home.orders.PostIMG')->middleware('auth');
