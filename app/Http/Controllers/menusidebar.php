<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class menusidebar extends Controller
{
    // public function dashboard(){
    //     return view('admin.dashboard');
    // }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function dataPasien()
    {
        return view('data-pasien.data-pasien');
    }

    public function datapegawai()
    {
        return view('data-pegawai.data-pegawai');
    }

    public function rekammedik()
    {
        return view('rekam-medik.rekam-medik');
    }

    public function antrian()
    {
        return view('antrian.antrian');
    }
    public function artikel()
    {
        return view('artikel.artikel');
    }
}
