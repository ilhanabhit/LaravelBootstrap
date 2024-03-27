<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\akun_admin;
use App\Models\User;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('nip', 'password');
    $user = akun_admin::where('nip', $credentials['nip'])->first();

    if ($user && $user->kata_sandi === $credentials['password']) {
        Auth::login($user);
        return redirect()->route('dashboard');
    } else {
        return redirect('login')->with('errorlogin', 'NIP atau password salah');
    }
}
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
