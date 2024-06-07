<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin(){
        return view('back.admin.index');
    }
    public function supervisor(){
        return view('back.supervisor.index');
    }
    public function petugas(){
        return view('back.petugas.index');
    }
}
