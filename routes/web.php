<?php

use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\ActionController;
use App\Http\Controllers\Admin\AttachmentsController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GaleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;

//fortify routes
require_once __DIR__ . '/fortify.php';
//admin routes
Route::prefix('Admin-panel/managment')->name('admin.')->middleware(['auth', 'has_role'])->group(function () {
    Route::get('/timeline', [EventController::class, 'index'])->name('timeline')->middleware('permission:events');
    Route::delete('/timeline/{event}', [EventController::class, 'destroy'])->name('timeline.destroy')->middleware('permission:events');
    Route::resource('galleries', GaleryController::class)->middleware('permission:galleries');
    Route::get('/prnpriview/{device}', [PrintController::class, 'prnpriview'])->name('print.device');
    Route::get('/prnprishow/{device}', [PrintController::class, 'show'])->middleware('permission:device-print')->name('print.device.show');
    Route::get('/print-report/{device}', [PrintController::class, 'printReport'])->name('print.print-report');

    Route::get('devices/{device}/edit', \App\Livewire\Admin\Devices\EditDevice::class)->middleware('permission:devices-edit')->name('devices.edit');
    Route::get('devices/category', \App\Livewire\Admin\Categories\CategoryController::class)->middleware('permission:categories-list')->name('devices.category');
    Route::get('devices/attribute', \App\Livewire\Admin\Attribute\AttributeManagement::class)->middleware('permission:attributes-list')->name('devices.attribute');
    Route::get('devices/create', \App\Livewire\Admin\Devices\CreateDevice::class)->middleware('permission:devices-create')->name('devices.create');
    Route::get('devices/archives', \App\Livewire\Admin\Devices\ArchiveDevice::class)->middleware('permission:devices-archive-list')->name('devices.archive');
    Route::get('devices/{device}', [DeviceController::class,'show'])->middleware('permission:devices-show')->name('devices.show');
    Route::get('devices',\App\Livewire\Admin\Devices\DeviceComponent::class)->middleware('permission:devices-list')->name('devices.index');
    //dossiers
    Route::get('dossiers/create', \App\Livewire\Admin\Dossiers\CreateDossier::class)->middleware('permission:dossiers-create')->name('dossiers.create');
    Route::get('dossiers/{dossier}/edit', \App\Livewire\Admin\Dossiers\EditDossier::class)->middleware('permission:dossiers-edit')->name('dossiers.edit');
    Route::get('dossiers/archives', \App\Livewire\Admin\Dossiers\ArchiveDossier::class)->middleware('permission:dossiers-archive-list')->name('dossiers.archive');
    Route::get('dossiers/{dossier}/show', function (\App\Models\Dossier $dossier){
        \Illuminate\Support\Facades\Gate::authorize('is-same-laboratory',$dossier->laboratory_id);
        $devices=$dossier->devices()->paginate(10);
        return view('admin.page.dossiers.show',compact(['dossier','devices']));
    })->middleware('permission:dossiers-show')->name('dossiers.show');
    Route::get('dossiers', \App\Livewire\Admin\Dossiers\DossierComponent::class)->middleware('permission:dossiers-list')->name('dossiers.index');

    Route::resource('users', UserController::class)->except('destroy')->middleware('permission:users');
    Route::resource('roles', RoleController::class)->except('show')->middleware('permission:roles');
    Route::get('permissions', \App\Livewire\Admin\Permissions\PermissionList::class)->name('permissions')->middleware('permission:permissions');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::view('/user/password', 'admin.page.auth.change-password')->name('profile.change-pass');
    Route::get('/settings', \App\Livewire\Admin\Settings\Setting::class)->name('settings.show')->middleware('permission:settings');

    Route::get('actions/{device}/create',  \App\Livewire\Admin\Actions\ActionControll::class)->name('actions.create')->middleware('permission:actions-create');
    Route::get('actions/action-category', \App\Livewire\Admin\Actions\CategoryAction::class)->name('actions.category')->middleware('permission:actions-category-list');
    Route::get('laboratory', \App\Livewire\Admin\Laboratories\LaboratoryControll::class)->name('laboratory')->middleware(['permission:laboratories-list']);

    //image routes
    Route::post('/upl', [DeviceController::class, 'uploadImage'])->name('uploade');
    Route::post('/del', [DeviceController::class, 'deleteImage'])->name('del');

    Route::get('/devices/{device}/images-edit',     [ImageController::class, 'edit'])->middleware('permission:device-image-edit')->name('devices.images.edit');
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
    Route::get('/export-Device', [BackupController::class, 'ExportDevices'])->middleware('permission:devices-export')->name('file-device');
    Route::get('/export-Users', [BackupController::class, 'ExportUsers'])->middleware('permission:users-export')->name('file-users');
    Route::get('/export-Dossiers', [BackupController::class, 'ExportDossiers'])->middleware('permission:dossiers-export')->name('file-dossier');
    Route::get('/export-Actions', [BackupController::class, 'ExportActions'])->middleware('permission:actions-export')->name('file-action');

    //Guides routes
    Route::get('guides/images', \App\Livewire\Admin\Guides\GuideImage::class)->name('guides.images');
    Route::get('guides/videos', \App\Livewire\Admin\Guides\GuideVideo::class)->name('guides.videos');
    Route::get('guides/files', \App\Livewire\Admin\Guides\GuideFile::class)->name('guides.files');

    Route::get('/', [DashboardController::class, 'index'])->name('home');
});
//end
Route::prefix('profile')->name('user.')->middleware(['auth'])->group(function () {
    Route::view('/', 'home.page.users_profile.index')->name('home');
    Route::put('/edit', [ProfileController::class, 'update'])->name('profile.update');
});
Route::get('refresh-captcha',function (){
    return response()->json(['captcha' => captcha_img()]);
});
Route::redirect('/', '/login')->middleware('guest');
