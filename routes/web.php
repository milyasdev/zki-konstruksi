<?php

use App\Http\Controllers\ControllelUmum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\FileSafeViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ControllelUmum::class, 'halamanDepan'])->name('halamanDepan');
Route::get('/login', [ControllelUmum::class, 'halamanLogin'])->name('login');
Route::post('/proses-login', [ControllerLogin::class, 'prosesLogin'])->name('prosesLogin');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Bagian Master Kategori ===========================================================================================================
    Route::get('/dashboard-admin', [ControllerAdmin::class, 'dashboard'])->name('dashboard');
    Route::get('/product', [ControllerAdmin::class, 'indexProduct'])->name('indexProduct');
    Route::get('/form-product', [ControllerAdmin::class, 'formProduct'])->name('formProduct');
    Route::post('/save-form-product', [ControllerAdmin::class, 'saveFormProduct'])->name('saveFormProduct');
    Route::get('/delete-product/{id}', [ControllerAdmin::class, 'deleteProduct'])->name('deleteProduct');
    Route::get('/edit-product/{id}',[ControllerAdmin::class, 'editFormProduct'])->name('formProductEdit');

    // Bagian Master Kategori ===========================================================================================================
    Route::get('/kategori', [ControllerAdmin::class, 'indexKategori'])->name('indexKategori');
    Route::get('/form-kategori', [ControllerAdmin::class, 'formKategori'])->name('formKategori');
    Route::post('/save-form-kategori', [ControllerAdmin::class, 'saveFormKategori'])->name('saveFormKategori');
    Route::get('/delete-kategori/{id}', [ControllerAdmin::class, 'deleteFormKategori'])->name('deleteFormKategori');


    // Bagian Function Ambil Gambar ===========================================================================================================
    Route::get('/portal/secure-image/{filename}', [FileSafeViewController::class, 'showPublicImage'])
        ->where('filename', '.*')
        ->name('portal.secure.image');

    Route::get('/portal/secure-pdf/{filename}', [FileSafeViewController::class, 'showPublicPdf'])
        ->where('filename', '.*')
        ->name('portal.secure.pdf');
});
