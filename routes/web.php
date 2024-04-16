<?php

use App\Events\NotificationMessage;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\DossierController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SmsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GaleryController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\DeviceController as HomeDeviceController;
use App\Http\Controllers\Home\QuestionController as HomeQuestionController;
use App\Http\Controllers\Home\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Actions\ActionControll;
use App\Livewire\Home\DevicesList;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PrintController;
//fortify routes
require_once __DIR__ . '/fortify.php';
//admin routes
Route::prefix('Admin-panel/managment')->name('admin.')->middleware(['auth','has_role'])->group(function () {
    Route::get('/timeline', [EventController::class, 'index'])->name('timeline')->middleware('permission:events');
    Route::delete('/timeline/{event}', [EventController::class, 'destroy'])->name('timeline.destroy')->middleware('permission:events');
    Route::resource('galeries',         GaleryController::class)->middleware('permission:galeries');
    Route::get('/prnpriview/{device}',[PrintController::class , 'prnpriview'])->name('print.device');
    Route::get('/prnprishow/{device}',[PrintController::class , 'show'])->name('print.device.show');
//livewire
    Route::get('devices/{device}/edit', \App\Livewire\Admin\Devices\EditDevice::class)->middleware('permission:devices')->name('devices.edit');
    Route::get('devices/create', \App\Livewire\Admin\Devices\CreateDevice::class)->middleware('permission:devices')->name('devices.create');

    Route::get('dossiers/create', \App\Livewire\Admin\Dossiers\CreateDossier::class)->middleware('permission:dossiers')->name('dossiers.create');
    Route::get('dossiers/{dossier}/edit', \App\Livewire\Admin\Dossiers\EditDossier::class)->middleware('permission:dossiers')->name('dossiers.edit');
    Route::get('dossiers/archives',         [DossierController::class, 'archive'])->name('dossiers.archive')->middleware('permission:dossiers');

    Route::resource('devices',         DeviceController::class)->middleware(['role_or_permission:devices|personel'])->only(['index', 'show']);
    Route::resource('dossiers',         DossierController::class)->middleware('permission:dossiers')->only(['index', 'show']);
    Route::get('archives',         [DeviceController::class, 'archive'])->name('archive')->middleware('permission:devices');
    Route::resource('users',            UserController::class)->except( 'destroy')->middleware('permission:users');
    Route::resource('roles',   RoleController::class)->except('show')->middleware('permission:roles');
//    Route::post('/sms/send-sms',   [SmsController::class,'sendSms'])->name('sms.sendSms')->middleware('permission:sms');
//    Route::resource('sms',   SmsController::class)->only('create','store')->middleware('permission:sms');
    Route::view('permissions', 'admin.page.permissions.index')->name('permissions')->middleware('permission:permissions');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::view('/user/password', 'admin.page.auth.change-password')->name('profile.change-pass');
    Route::get('/settings', \App\Livewire\Admin\Settings\Setting::class)->name('settings.show')->middleware('permission:settings');
    Route::get('actions/{device}/create',  \App\Livewire\Admin\Actions\ActionControll::class)->name('actions.create')->middleware(['role_or_permission:actions|personel']);
    Route::get('/devices/{device}/images-edit',     [ImageController::class, 'edit'])->name('devices.images.edit');
    Route::get('/', [DashboardController::class, 'index'])->name('home');

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
Route::prefix('profile')->name('user.')->middleware(['auth'])->group(function() {
    Route::view('/','home.page.users_profile.index')->name('home');
    Route::put('/edit', [ProfileController::class, 'update'])->name('profile.update');
});
//admin auth
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
Route::redirect('/','/login')->middleware('guest');
