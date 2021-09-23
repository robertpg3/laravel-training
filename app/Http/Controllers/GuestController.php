<?php

namespace App\Http\Controllers;

class GuestController extends Controller
{
    public function index()
    {
        return view('auth/base-view');
    }

    public function indexLogin()
    {
        return view('auth/login');
    }

    public function indexRegister()
    {
        return view('auth/register');
    }

    public function indexVerifyEmail()
    {
        return view('auth/verify-email');
    }

    public function index2FA()
    {
        return view('auth/two-factor-challenge');
    }

    public function indexForgotPassword()
    {
        return view('auth/forgot-password');
    }
}
