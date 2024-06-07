<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\harga;
use Illuminate\Http\Request;

class hargacontroller extends Controller
{
    public function index(){
        $harga = harga::get();
        return view('back.harga.index', compact('harga'));
    }
}
