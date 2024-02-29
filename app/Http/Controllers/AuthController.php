<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $credentials = $request->only('username', 'password');
        // $user = User::where('username', $credentials['username'])->first();

        // if ($user && $user->password === md5($credentials['password'])) {
        //     Auth::login($user);
            return redirect('/dashboard'); // Sesuaikan dengan rute dashboard yang Anda gunakan
        // } else {
        //     return redirect('/login')->with('error', 'Invalid credentials');
        // }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
