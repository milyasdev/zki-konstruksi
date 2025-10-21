<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerAdmin extends Controller
{
    public function dashboard(){
        return view('backend.dashboard');
    }

    public function indexProduct(){
        return view('backend.product.index');
    }

    public function formProduct(){
        return view('backend.product.form');
    }
}
