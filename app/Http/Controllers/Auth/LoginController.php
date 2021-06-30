<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if(Auth::guard()->attempt(['username' => $request->username, 'password' => $request->password])){
            if (auth()->guard()->user()->status == 'Tidak Aktif') {
                Auth::guard()->logout();
                return redirect()->back()->with('message', 'Akun Anda Telah Dinonaktifkan');
            } else {
                return redirect()->intended('dashboard');
            }
        } else {
            return redirect()->back()->with('message', 'Username atau Password Anda Salah');
        }
    }

    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('Login Form');
    }
}
