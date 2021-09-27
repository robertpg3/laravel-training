<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function indexConfirmPassword()
    {
        return view('auth/confirm-password');
    }

    public function indexResetPassword()
    {
        return view('auth/reset-password');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/index');
    }

    public function checkRole()
    {
        if (Auth::user()->role == 'admin') {
            return redirect('admin/products');
        } else if (Auth::user()->role == 'client') {
            return redirect('/products');
        }
    }
}
