<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\Controller,
    Models\jenisSampah,
    Models\kategori,
    Models\User,
};

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(){
        return view('back.admin.index',[
            'totalUser' => User::count(),
            'totalKategori' => kategori::count(),
            'totalJenis'    => jenisSampah::count()
        ]);
    }
    public function supervisor(){
        return view('back.supervisor.index',[
            'totalUser' => User::count(),
            'totalKategori' => kategori::count(),
            'totalJenis'    => jenisSampah::count()
        ]);
    }
    public function petugas(){
        return view('back.petugas.index',[
            'totalUser' => User::count(),
            'totalKategori' => kategori::count(),
            'totalJenis'    => jenisSampah::count()
        ]);
    }
}
