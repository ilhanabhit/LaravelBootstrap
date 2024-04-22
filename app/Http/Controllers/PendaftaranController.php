<?php

namespace App\Http\Controllers;

use App\Models\pendaftaran; // Mengubah namespace model menjadi Pendaftaran
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pendaftaran dari database
        $dataPendaftaran = pendaftaran::all(); // Mengambil data dari model Pendaftaran
        // Tampilkan data pendaftaran ke view data-pendaftaran.data-pendaftaran
        return view('data-pendaftaran.data-pendaftaran', compact('dataPendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat data pendaftaran baru
        return view('data-pendaftaran.buat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'id_pendaftaran' => 'required|max:255',
            'nik' => 'required|string|max:255',
            'id_poli' => 'required|string|max:255',
            'tanggal_pendaftaran' => 'required|date',
            'deskripsi_keluhan' => 'required|string',
            'status' => 'required|string|max:255',
            'antrian' => 'required|string|max:255',
        ]);

        // Simpan data ke dalam database
        pendaftaran::create($validatedData); // Menggunakan model Pendaftaran untuk menyimpan data

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $pendaftaran = pendaftaran::findOrFail($id); // Mengambil data dari model Pendaftaran
        // Tampilkan detail data pendaftaran
        return view('data-pendaftaran.detail', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data pendaftaran berdasarkan ID
        $pendaftaran = pendaftaran::findOrFail($id); // Mengambil data dari model Pendaftaran
        // Tampilkan form untuk mengedit data pendaftaran
        return view('data-pendaftaran.edit', compact('pendaftaran'));
    }

    public function insert(Request $request)
{
    try {
        // Mendapatkan nilai id_pendaftaran dari request atau mengisi sendiri sesuai kebutuhan aplikasi
        $id_pendaftaran = $request->input('id_pendaftaran'); // atau nilai id_pendaftaran yang Anda tentukan

        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'nik' => 'required|string|max:255',
            'id_poli' => 'required|string|max:255',
            'tanggal_pendaftaran' => 'required|date',
            'deskripsi_keluhan' => 'required|max:255',
            'status' => 'required|string|max:255',
            'antrian' => 'required|string|max:255',
        ]);

        // Menambahkan nilai id_pendaftaran ke dalam array data yang akan disimpan
        $validatedData['id_pendaftaran'] = $id_pendaftaran;

        // Memasukkan data pendaftaran baru
        $pendaftaran = new Pendaftaran; 
        $pendaftaran->id_pendaftaran = $id_pendaftaran; // Atur id_pendaftaran secara manual
        $pendaftaran->nik = $validatedData['nik'];
        $pendaftaran->id_poli = $validatedData['id_poli'];
        $pendaftaran->tanggal_pendaftaran = $validatedData['tanggal_pendaftaran'];
        $pendaftaran->deskripsi_keluhan = $validatedData['deskripsi_keluhan'];
        $pendaftaran->status = $validatedData['status'];
        $pendaftaran->antrian = $validatedData['antrian'];
        $pendaftaran->save(); 

        Session::flash('success', 'Data Pendaftaran berhasil disimpan!');

        // Redirect ke halaman index dengan notifikasi success
        return redirect()->route('pendaftaran');
    } catch (QueryException $e) {
        // Tangkap eksepsi query exception dan ambil pesan kesalahannya
        $sqlErrorMessage = $e->getMessage();

        // Kembalikan ke halaman sebelumnya dengan pesan error SQL
        return back()->withErrors('Gagal menyimpan Pendaftaran. Error SQL: ' . $sqlErrorMessage);
    }
}





    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $id_pendaftaran = $request->input('id_pendaftaran');

            // Hapus data pendaftaran dari database
            pendaftaran::where('id_pendaftaran', $id_pendaftaran)->delete(); // Menggunakan model Pendaftaran untuk menghapus data

            Session::flash('success', 'Data pendaftaran berhasil dihapus!');

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('pendaftaran');
        } catch (QueryException $e) {
            // Tangkap eksepsi query exception dan ambil pesan kesalahannya
            $sqlErrorMessage = $e->getMessage();

            // Kembalikan ke halaman sebelumnya dengan pesan error SQL
            return back()->withErrors('Gagal menghapus data pendaftaran. Error SQL: ' . $sqlErrorMessage);
        }
    }
}
