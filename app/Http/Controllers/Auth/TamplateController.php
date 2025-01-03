<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TamplateController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        return view('user.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.tamplate');
    }

    public function overview()
    {
        return view('user.profile.overview');
    }

    public function settings()
    {
        return view('user.profile.settings');
    }
}
