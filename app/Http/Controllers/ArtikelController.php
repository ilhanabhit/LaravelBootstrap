<?php

namespace App\Http\Controllers;

use App\Models\artikel; // Mengubah namespace model menjadi Artikel
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data artikel dari database
        $dataArtikel = artikel::all(); // Mengambil data dari model Artikel
        // Tampilkan data artikel ke view data-artikel.data-artikel
        return view('data-artikel.data-artikel', compact('dataArtikel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat data artikel baru
        return view('data-artikel.buat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'id_artikel' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tanggal_publikasi' => 'required|date',
            'img_artikel' => 'required|string|max:255',
            'isi_artikel' => 'required|string',
            'nip' => 'required|string|max:255',
        ]);

        // Simpan data ke dalam database
        artikel::create($validatedData); // Menggunakan model Artikel untuk menyimpan data

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('artikel.index')->with('success', 'Data artikel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data artikel berdasarkan ID
        $artikel = artikel::findOrFail($id); // Mengambil data dari model Artikel
        // Tampilkan detail data artikel
        return view('data-artikel.detail', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data artikel berdasarkan ID
        $artikel = artikel::findOrFail($id); // Mengambil data dari model Artikel
        // Tampilkan form untuk mengedit data artikel
        return view('data-artikel.edit', compact('artikel'));
    }

    public function insert(Request $request)
    {
        try {
            // Validasi input sesuai kebutuhan
            $validatedData = $request->validate([
                'id_artikel' => 'required|string|max:255',
                'judul' => 'required|string|max:255',
                'tanggal_publikasi' => 'required|date',
                'img_artikel' => 'required|string|max:255',
                'isi_artikel' => 'required|string',
                'nip' => 'required|string|max:255',
            ]);

            // Memasukkan data artikel baru
            $artikel = artikel::create($validatedData); // Menggunakan model Artikel untuk menyimpan data

            Session::flash('success', 'Data Artikel berhasil disimpan!');

            // Redirect ke halaman index dengan notifikasi success
            return redirect()->route('artikel');
        } catch (QueryException $e) {
            // Tangkap eksepsi query exception dan ambil pesan kesalahannya
            $sqlErrorMessage = $e->getMessage();

            // Kembalikan ke halaman sebelumnya dengan pesan error SQL
            return back()->withErrors('Gagal menyimpan Artikel. Error SQL: ' . $sqlErrorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $id_artikel = $request->input('id_artikel');

            // Hapus data artikel dari database
            Artikel::where('id_artikel', $id_artikel)->delete(); // Menggunakan model Artikel untuk menghapus data

            Session::flash('success', 'Data artikel berhasil dihapus!');

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('artikel');
        } catch (QueryException $e) {
            // Tangkap eksepsi query exception dan ambil pesan kesalahannya
            $sqlErrorMessage = $e->getMessage();

            // Kembalikan ke halaman sebelumnya dengan pesan error SQL
            return back()->withErrors('Gagal menghapus data artikel. Error SQL: ' . $sqlErrorMessage);
        }
    }
}
