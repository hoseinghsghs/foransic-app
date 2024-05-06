<?php

use App\Events\NotificationMessage;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\ActionController;
use App\Http\Controllers\Admin\AttachmentsController;
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
use App\Livewire\Home\DevicesList;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PrintController;

//fortify routes
require_once __DIR__ . '/fortify.php';
//admin routes
Route::prefix('Admin-panel/managment')->name('admin.')->middleware(['auth', 'has_role'])->group(function () {
    Route::get('/timeline', [EventController::class, 'index'])->name('timeline')->middleware('permission:events');
    Route::delete('/timeline/{event}', [EventController::class, 'destroy'])->name('timeline.destroy')->middleware('permission:events');
    Route::resource('galleries', GaleryController::class)->middleware('permission:galleries');
    Route::get('/prnpriview/{device}', [PrintController::class, 'prnpriview'])->name('print.device');
    Route::get('/prnprishow/{device}', [PrintController::class, 'show'])->name('print.device.show');
    Route::get('/print-report/{device}', [PrintController::class, 'printReport'])->name('print.print-report');
//livewire
    Route::get('devices/{device}/edit', \App\Livewire\Admin\Devices\EditDevice::class)->middleware('permission:devices-edit')->name('devices.edit');
    Route::get('devices/create', \App\Livewire\Admin\Devices\CreateDevice::class)->middleware('permission:devices-create')->name('devices.create');
    Route::get('devices/archives', [DeviceController::class, 'archive'])->middleware('permission:devices-archive-list')->name('archive');
    Route::get('devices/category', \App\Livewire\Admin\Categories\CategoryController::class)->middleware('permission:categories-list')->name('category');
    Route::get('devices/attribute', \App\Livewire\Admin\Attribute\AttributeManagement::class)->middleware('permission:attributes-list')->name('attribute');
    Route::resource('devices', DeviceController::class)->only(['index', 'show']);
    //dossiers
    Route::get('dossiers/create', \App\Livewire\Admin\Dossiers\CreateDossier::class)->middleware('permission:dossiers-create')->name('dossiers.create');
    Route::get('dossiers/{dossier}/edit', \App\Livewire\Admin\Dossiers\EditDossier::class)->middleware('permission:dossiers-edit')->name('dossiers.edit');
    Route::get('dossiers/archives', \App\Livewire\Admin\Dossiers\ArchiveDossier::class)->middleware('permission:dossiers-archive-list')->name('dossiers.archive');
    Route::get('dossiers/{dossier}/show', function (\App\Models\Dossier $dossier){
        return view('admin.page.dossiers.show',compact('dossier'));
    })->middleware('permission:dossiers-show')->name('dossiers.show');
    Route::get('dossiers', \App\Livewire\Admin\Dossiers\DossierComponent::class)->middleware('permission:dossiers-list')->name('dossiers.index');

    Route::resource('users', UserController::class)->except('destroy')->middleware('permission:users');
    Route::resource('roles', RoleController::class)->except('show')->middleware('permission:roles');

    Route::view('permissions', 'admin.page.permissions.index')->name('permissions')->middleware('permission:permissions');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::view('/user/password', 'admin.page.auth.change-password')->name('profile.change-pass');
    Route::get('/settings', \App\Livewire\Admin\Settings\Setting::class)->name('settings.show')->middleware('permission:settings');
    Route::get('actions/{device}/create',  \App\Livewire\Admin\Actions\ActionControll::class)->name('actions.create')->middleware(['role_or_permission:actions|personel']);

    Route::get('actions/action-category', \App\Livewire\Admin\Actions\CategoryAction::class)->name('actions.category')->middleware(['role_or_permission:actions|personel']);
    Route::get('laboratory', \App\Livewire\Admin\Laboratories\LaboratoryControll::class)->name('laboratory')->middleware(['role_or_permission:actions|personel']);

    Route::get('/devices/{device}/images-edit',     [ImageController::class, 'edit'])->name('devices.images.edit');
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    //image routes
    Route::post('/upl', [DeviceController::class, 'uploadImage'])->name('uploade');
    Route::post('/del', [DeviceController::class, 'deleteImage'])->name('del');
    Route::post('/editupl', [ImageController::class, 'edit_uploadImage'])->name('edit_uploade');
    Route::post('/editdel', [ImageController::class, 'edit_deleteImage'])->name('edit_del');
    Route::post('/add_image', [ImageController::class, 'setPrimary'])->name('device.images.add');

    //attached file routes
    Route::post('/attachments-upl', [ActionController::class, 'uploadAttachment'])->name('attachments_uploade');
    Route::post('/attachments-del', [ActionController::class, 'deleteAttachment'])->name('attachments_del');
    Route::post('/attachments-editupl', [AttachmentsController::class, 'attachments-edit_uploadImage'])->name('attachments_edit_uploade');
    Route::post('/attache-editdel', [AttachmentsController::class, 'attachments-edit_deleteImage'])->name('attachments_edit_del');
    Route::post('/attachments-add_file', [AttachmentsController::class, 'attachments-setPrimary'])->name('attachments_device.files.add');

    //excel exports
    Route::get('/export-Device', [BackupController::class, 'ExportDevices'])->middleware('permission:dossiers-export')->name('file-device');
    Route::get('/export-Users', [BackupController::class, 'ExportUsers'])->middleware('permission:users-export')->name('file-users');
    Route::get('/export-Dossiers', [BackupController::class, 'ExportDossiers'])->middleware('permission:dossiers-export')->name('file-dossier');
    Route::get('/export-Actions', [BackupController::class, 'ExportActions'])->middleware('permission:actions-export')->name('file-action');

    //Multi-vendor
    // Route::resource('shop',   ShopController::class)->except('show')->middleware('permission:roles');
});
//end
Route::prefix('profile')->name('user.')->middleware(['auth'])->group(function () {
    Route::view('/', 'home.page.users_profile.index')->name('home');
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
Route::redirect('/', '/login')->middleware('guest');
