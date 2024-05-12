<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\pasien;
use App\Models\rekammedis;
use App\Models\pendaftaran;
use Illuminate\Http\Request;


class menusidebar extends Controller
{
    // public function dashboard(){
    //     return view('admin.dashboard');
    // }

    public function dashboard()
    {
        $data = pasien::getAllPasien();
        $rekammedis = rekammedis::getData();
        // dd($rekammedis);

        return view('admin.dashboard', [
            'data' => $data,
            'rekammedis' => $rekammedis,

        ]);
    }
    public function dataPasien()
    {
        $tabel = pasien::getdata();

        return view(
            'data-pasien.data-pasien',
            [
                'tabel' => $tabel,
            ]
        );
    }

    public function datapegawai()
    {

        return view('data-pegawai.data-pegawai');
    }

    public function rekammedis()
    {
        $tabel = rekammedis::getdata();

        return view(
            'rekam-medis.rekam-medis',
            [
                'tabel' => $tabel,
            ]
        );
    }

    public function pendaftaran()
    {
        $tabel = pendaftaran::getData();

        return view(
            'pendaftaran.pendaftaran',
            [
                'tabel' => $tabel,
            ]
        );
    }

    public function artikel()
    {
        $tabel = artikel::getData();

        return view(
            'artikel.artikel',
            [
                'tabel' => $tabel,
            ]
        );
    }
}
