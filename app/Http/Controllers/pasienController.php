<?php

namespace App\Http\Controllers;

use App\Models\pasien;

use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pasien dari database
        $dataPasien = pasien::all();
        // Tampilkan data pasien ke view data-pasien.data-pasien
        return view('data-pasien.data-pasien', compact('dataPasien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat data pasien baru
        return view('data-pasien.buat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'nik' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_bpjs' => 'required|string|max:255',
        ]);

        // Simpan data ke dalam database
        Pasien::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data pasien berdasarkan ID
        $pasien = pasien::findOrFail($id);
        // Tampilkan detail data pasien
        return view('data-pasien.detail', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data pasien berdasarkan ID
        $pasien = pasien::findOrFail($id);
        // Tampilkan form untuk mengedit data pasien
        return view('data-pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'nik' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_bpjs' => 'required|string|max:255',
        ]);

        // Ambil data pasien berdasarkan ID
        $pasien = pasien::findOrFail($id);
        // Update data pasien dengan data baru
        $pasien->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data pasien berdasarkan ID
        $pasien = pasien::findOrFail($id);
        $pasien->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus!');
    }
}
