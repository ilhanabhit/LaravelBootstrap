<?php

namespace App\Http\Controllers;
use App\Models\pasien;
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
        $tabel = pasien::getdata();

        return view('data-pasien.data-pasien',
    [
        'tabel' => $tabel,
    ]);
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
