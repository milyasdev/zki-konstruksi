<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllelUmum extends Controller
{
    public function halamanDepan()
    {
        return view('front');
    }

    public function halamanLogin(){
        return view('login');
    }
}
