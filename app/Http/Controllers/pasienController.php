<?php

namespace App\Http\Controllers;

use App\Models\pasien;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


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

        // Memeriksa apakah nama pasien sudah ada dalam database
        $existingPasien = pasien::where('nama', $validatedData['nama'])->first();

        if ($existingPasien) {
            // Jika nama pasien sudah ada, kembalikan pesan kesalahan
            return redirect()->route('pasien.index')->with('error', 'Data pasien dengan nama tersebut sudah ada!');
        } else {
            // Jika nama pasien belum ada, tambahkan data baru ke database
            pasien::create($validatedData);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan!');
        }
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




    public function insert(Request $request)
    {
        try {
            // Validasi input sesuai kebutuhan
            $validatedData = $request->validate([
                'nik' => 'required|string|size:16|regex:/^\d+$/',
                'nama' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'no_bpjs' => 'nullable|size:13|regex:/^\d+$/',
            ], [
                'nik.size' => 'NIK harus terdiri dari 16 angka.',
                'nik.regex' => 'NIK harus terdiri dari angka saja.',
                'no_bpjs.size' => 'Nomor BPJS harus terdiri dari 13 angka.',
                'no_bpjs.regex' => 'Nomor BPJS harus terdiri dari angka saja.',
            ]);

            // Memeriksa apakah nama pasien sudah ada dalam database
            $existingPasien = Pasien::where('nama', $validatedData['nama'])->first();

            if ($existingPasien) {
                // Jika nama pasien sudah ada, kembalikan pesan kesalahan
                Session::flash('error', 'Data pasien sudah ada');

                // Redirect ke halaman index dengan notifikasi error
                return redirect()->route('data-pasien');
            } else {
                // Jika nama pasien belum ada, tambahkan data baru ke database
                Pasien::create($validatedData);

                // Redirect ke halaman index dengan pesan sukses
                Session::flash('success', 'Data pasien berhasil disimpan!');

                // Redirect ke halaman index dengan notifikasi success
                return redirect()->route('data-pasien');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika validasi gagal, kembalikan pesan kesalahan validasi ke halaman sebelumnya
            return back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            $sqlErrorMessage = $e->getMessage();

            // Set pesan error dalam session
            Session::flash('error', 'Gagal menyimpan Rekam Medis. Error SQL: ' . $sqlErrorMessage);

            // Kembalikan ke halaman sebelumnya
            return back();
        }
    }





    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $nik = $request->input('nik');

            // Hapus data pasien dari database
            Pasien::where('nik', $nik)->delete();

            Session::flash('success', 'Data pasien berhasil dihapus!');

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('data-pasien');
        } catch (QueryException $e) {
            $sqlErrorMessage = $e->getMessage();

            // Set pesan error dalam session
            Session::flash('error', 'Gagal menghapus data pasien. Error SQL: ' . $sqlErrorMessage);

            // Kembalikan ke halaman sebelumnya
            return back();
        }
    }
}
