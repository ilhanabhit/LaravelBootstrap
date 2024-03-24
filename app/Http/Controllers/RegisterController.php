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
            'nip' => 'required|unique:pegawai,nip',
            'nama' => 'required',
            'email' => 'required|email|unique:pegawai,email',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'kata_sandi' => 'required|min:6',
        ]);

        $pegawai = new akun_admin();
        $pegawai->nip = $request->nip;
        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->jenis_kelamin = $request->jenis_kelamin;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->kata_sandi = $request->kata_sandi;
        $pegawai->save();

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }


}
