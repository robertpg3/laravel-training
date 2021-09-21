<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use \Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('account-views/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            Session::put('user', $user);
            if($user['role'] == 'admin')
                return redirect()->intended('admin/products');
            elseif($user['role'] == 'client')
                return redirect()->intended('/products');
            else return false;
        }
    }

    public function indexHome()
    {
        return view('home');
    }

    public function indexRegister(Request $request)
    {
        return view('account-views/register');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        $user->sendEmailVerificationNotification();

        return redirect()->intended('login');
    }

    public function showForgotPasswordForm(Request $request)
    {
        return view('account-views/forgot-form');

    }

    public function resetPassword(Request $request)
    {
        return view('account-views/reset-form');
    }

    public function sendPasswordMail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        return back();
    }

    public function changePassword(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $hashedPassword = Hash::make($request->newPassword);
            $result = User::where('email', 'like', $request->email)->update(['password' => $hashedPassword]);

            return redirect()->intended('login');
        }

        return view('account-views/error');
    }

    public function recoverNewPasswordForm(Request $request)
    {
        return view('account-views/recover-password');
    }

    public function recoverNewPassword(Request $request)
    {
        $hashedPassword = Hash::make($request->newPassword);
        $result = User::where('email', 'LIKE', $request->email)->update(['password' => $hashedPassword]);

        return redirect()->intended('login');
    }

    public function confirmRegister(Request $request)
    {
        User::where('id', '=', $request->input('id'))->update(['email_verified_at' => now()]);

        return redirect()->intended('login');
    }
}
