<?php

use App\Http\Controllers\ControllelUmum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\ControllerLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', [ControllelUmum::class, 'halamanDepan'])->name('halamanDepan');
Route::get('/login', [ControllelUmum::class, 'halamanLogin'])->name('login');
Route::post('/proses-login', [ControllerLogin::class, 'prosesLogin'])->name('prosesLogin');


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard-admin', [ControllerAdmin::class, 'dashboard'])->name('dashboard');
    Route::get('/product', [ControllerAdmin::class, 'indexProduct'])->name('indexProduct');
    Route::get('/form-product', [ControllerAdmin::class, 'formProduct'])->name('formProduct');

});


