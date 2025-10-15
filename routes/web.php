<?php

use App\Http\Controllers\ControllelUmum;
use Illuminate\Support\Facades\Route;

Route::get('/', [ControllelUmum::class, 'halamanDepan']);
