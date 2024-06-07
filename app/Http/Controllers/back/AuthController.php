<?php

namespace App\Http\Controllers\back;

use App\{
    Http\Controllers\Controller,
};
use Illuminate\{
    Support\Facades\Auth,
    Http\Request,
};

class AuthController extends Controller
{
    public function index(){
        return view('back.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            $user = Auth::user();

            // Periksa level pengguna dan arahkan sesuai dengan level
            if ($user->level === 'admin') {
                return redirect()->route('admin.index');
            } elseif ($user->level === 'supervisor') {
                return redirect()->route('supervisor.index');
            } elseif ($user->level === 'petugas') {
                return redirect()->route('petugas.index');
            }
        } else {
            return redirect()->back()->withErrors('Username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
