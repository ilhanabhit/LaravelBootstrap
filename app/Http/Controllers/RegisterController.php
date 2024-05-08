<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\akun_admin;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nip' => 'required|',
            'kata_sandi' => 'required|',
            'konfirmasi_kata_sandi' => 'required',
        ]);

        $pegawai = akun_admin::find($request->nip);
        // $pegawai->nip = $request->nip;
        $pegawai->kata_sandi = $request->konfirmasi_kata_sandi;
        // $pegawai->konfirmasi_password = $request->konfirmasi_password;
        $pegawai->save();

        return redirect()->route('login')->with('success', 'Sandi Telah di Reset. Silakan login.');
    }


}
