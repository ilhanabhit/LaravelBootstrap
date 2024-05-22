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
    public function update(Request $request)
{
    try {
        // Validasi input
        $request->validate([
            'id_pendaftaran' => 'required',
            'id_poli' => 'required',
            'nik' => 'required|string|size:16|regex:/^\d+$/', // Atur panjang NIK menjadi 16 angka dan memastikan hanya angka yang diterima
            'tanggal_pendaftaran' => 'required|date',
            'deskripsi_keluhan' => 'required',
            'status_pendaftaran' => 'required',
            'antrian' => 'required',
        ]);

        // Memeriksa apakah nomor antrian sudah digunakan untuk status pendaftaran yang sama
        $existingAntrian = Pendaftaran::where('status_pendaftaran', $request->status_pendaftaran)
                                      ->where('antrian', $request->antrian)
                                      ->where('id_pendaftaran', '!=', $request->id_pendaftaran) // Exclude current record from check
                                      ->exists();
        if ($existingAntrian) {
            // Jika nomor antrian sudah digunakan untuk status pendaftaran yang sama, kembalikan pesan error
            return redirect()->back()->withErrors('Nomor antrian tersebut sudah digunakan untuk status pendaftaran yang sama.');
        }

        // Update data pendaftaran berdasarkan ID
        Pendaftaran::where('id_pendaftaran', $request->id_pendaftaran)->update([
            'id_poli' => $request->id_poli,
            'nik' => $request->nik,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'deskripsi_keluhan' => $request->deskripsi_keluhan,
            'status_pendaftaran' => $request->status_pendaftaran,
            'antrian' => $request->antrian,
        ]);

        // Redirect ke halaman atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Data pendaftaran berhasil diperbarui');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Tangani error validasi
        $validationErrors = $e->validator->errors();

        // Tampilkan pesan error sesuai dengan aturan validasi
        if ($validationErrors->has('nik') && $validationErrors->get('nik')[0] == 'NIK harus terdiri dari 16 angka.') {
            $errorMessage = 'NIK harus terdiri dari 16 angka.';
        } elseif ($validationErrors->has('nik') && $validationErrors->get('nik')[0] == 'nik tidak valid.') {
            $errorMessage = 'NIK tidak valid.';
        } else {
            $errorMessage = $e->getMessage();
        }

        // Kembalikan ke halaman sebelumnya dengan pesan error
        return redirect()->back()->withErrors('Gagal memperbarui data pendaftaran. Error: ' . $errorMessage);
    }
}



public function insert(Request $request)
{
    try {
        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'id_pendaftaran' => 'required|string|max:255|unique:pendaftaran,id_pendaftaran', // Validasi unik untuk id_pendaftaran
            'nik' => 'required|string|size:16|unique:pendaftaran,nik', // atur panjang NIK menjadi 16 angka dan pastikan unik
            'id_poli' => 'required|string|max:255',
            'tanggal_pendaftaran' => 'required|date',
            'deskripsi_keluhan' => 'required|max:255',
            'status_pendaftaran' => 'required|string|max:255',
            'antrian' => 'required|string|max:255',
        ]);

        // Memeriksa apakah nomor antrian sudah digunakan untuk status pendaftaran yang sama
        $existingAntrian = Pendaftaran::where('status_pendaftaran', $validatedData['status_pendaftaran'])
                                      ->where('antrian', $validatedData['antrian'])
                                      ->exists();
        if ($existingAntrian) {
            // Jika nomor antrian sudah digunakan untuk status pendaftaran yang sama, kembalikan pesan error
            return back()->withErrors('Nomor antrian tersebut sudah digunakan untuk status pendaftaran yang sama.');
        }

        // Memasukkan data pendaftaran baru
        $pendaftaran = new Pendaftaran; 
        $pendaftaran->id_pendaftaran = $validatedData['id_pendaftaran']; // Set id_pendaftaran dari input
        $pendaftaran->nik = $validatedData['nik'];
        $pendaftaran->id_poli = $validatedData['id_poli'];
        $pendaftaran->tanggal_pendaftaran = $validatedData['tanggal_pendaftaran'];
        $pendaftaran->deskripsi_keluhan = $validatedData['deskripsi_keluhan'];
        
        // Pastikan data yang dimasukkan ke 'status_pendaftaran' tidak melebihi panjang maksimum yang diizinkan
        $status_pendaftaran = substr($validatedData['status_pendaftaran'], 0, 255);
        $pendaftaran->status_pendaftaran = $status_pendaftaran;

        $pendaftaran->antrian = $validatedData['antrian'];
        $pendaftaran->save(); 

        // Set flash message
        session()->flash('success', 'Data Antrian berhasil disimpan!');

        // Redirect ke halaman index dengan notifikasi success
        return redirect()->route('pendaftaran');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Tangkap eksepsi validasi
        $validationErrors = $e->validator->errors();

        // Tampilkan pesan error sesuai dengan aturan validasi
        if ($validationErrors->has('id_pendaftaran') && $validationErrors->get('id_pendaftaran')[0] == 'The id pendaftaran has already been taken.') {
            $errorMessage = 'ID Pendaftaran sudah ada.';
        } elseif ($validationErrors->has('nik') && $validationErrors->get('nik')[0] == 'NIK harus terdiri dari 16 angka.') {
            $errorMessage = 'NIK harus terdiri dari 16 angka.';
        } elseif ($validationErrors->has('nik') && $validationErrors->get('nik')[0] == 'NIK sudah terdaftar.') {
            $errorMessage = 'NIK sudah terdaftar.';
        } else {
            $errorMessage = $e->getMessage();
        }

        // Kembalikan ke halaman sebelumnya dengan pesan error
        return back()->withErrors('Gagal menyimpan Pendaftaran. Error: ' . $errorMessage);
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
