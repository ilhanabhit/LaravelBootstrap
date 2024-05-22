<?php

namespace App\Http\Controllers;

use App\Models\artikel; // Mengubah namespace model menjadi Artikel
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function update(Request $request)
{
    try {
        // Validasi input
        $request->validate([
            'id_artikel' => 'required',
            'judul' => 'required',
            'tanggal_publikasi' => 'required|date',
            'isi_artikel' => 'required|string',
            'nip' => 'required|string|max:255|exists:pegawai,nip', // Pastikan nip ada di tabel pegawai
            'img_artikel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Menambahkan validasi untuk gambar
        ]);

        // Ambil artikel berdasarkan ID
        $artikel = Artikel::findOrFail($request->id_artikel);

        // Update data artikel
        $artikel->judul = $request->judul;
        $artikel->tanggal_publikasi = $request->tanggal_publikasi;
        $artikel->isi_artikel = $request->isi_artikel;
        $artikel->nip = $request->nip;

        // Cek apakah gambar baru diunggah
        if ($request->hasFile('img_artikel')) {
            $imagePath = $request->file('img_artikel');
            $tujuan = 'gambar';
            $nama = $tujuan . '/' . time() . '_' . $imagePath->getClientOriginalName();
            $imagePath->move($tujuan, $nama);
            $artikel->img_artikel = $nama;
        }

        // Simpan perubahan
        $artikel->save();

        // Redirect ke halaman atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Data artikel berhasil diperbarui');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Artikel tidak ditemukan.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Tangani kesalahan validasi
        $errorMessage = $e->validator->errors()->first(); // Ambil pesan kesalahan pertama
        return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        // Tangani error umum
        return redirect()->back()->with('error', 'Gagal memperbarui artikel. Error: ' . $e->getMessage());
    }
}





    public function insert(Request $request)
{
    try {
        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'id_artikel' => 'required|string|max:255|unique:artikel,id_artikel', // Pastikan id artikel unik
            'judul' => 'required|string|max:255|unique:artikel,judul', // Pastikan judul unik dan tidak melebihi panjang maksimum
            'tanggal_publikasi' => 'required|date',
            'img_artikel' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Pastikan img_artikel unik dan format gambar yang diizinkan
            'isi_artikel' => 'required|string',
            'nip' => 'required|string|max:255|exists:pegawai,nip', // Pastikan nip ada di tabel pegawai
        ]);

        // Memeriksa panjang judul
        if (strlen($validatedData['judul']) > 255) {
            throw new \Exception('Panjang judul melebihi batas maksimum.');
        }

        // Menyimpan gambar
        if ($request->hasFile('img_artikel')) {
            $imagePath = $request->file('img_artikel');
            $nama = 'gambar/' . time() . '_' . $imagePath->getClientOriginalName();
            $imagePath->move(public_path('gambar'), $nama);
            $validatedData['img_artikel'] = $nama;
        }

        // Memeriksa apakah nip ada di database pegawai
        $pegawaiExist = DB::table('pegawai')->where('nip', $validatedData['nip'])->exists();
        if (!$pegawaiExist) {
            // Jika nip tidak ada di database pegawai, kembalikan pesan error
            return back()->withErrors('NIP Harus sama dengan yang di daftarkan .');
        }

        // Memasukkan data artikel baru
        $artikel = Artikel::create($validatedData); // Menggunakan model Artikel untuk menyimpan data

        // Set flash message
        session()->flash('success', 'Data Artikel berhasil disimpan!');

        // Redirect ke halaman index dengan notifikasi success
        return redirect()->route('artikel');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Tangkap eksepsi validasi
        $errorMessage = $e->getMessage();

        // Kembalikan ke halaman sebelumnya dengan pesan error validasi
        return back()->withErrors('Gagal menyimpan Artikel. Error: ' . $errorMessage);
    } catch (\Illuminate\Database\QueryException $e) {
        // Tangkap eksepsi query exception dan ambil pesan kesalahannya
        $sqlErrorMessage = $e->getMessage();

        // Kembalikan ke halaman sebelumnya dengan pesan error SQL
        return back()->withErrors('Gagal menyimpan Artikel. Error SQL: ' . $sqlErrorMessage);
    } catch (\Exception $e) {
        // Tangkap eksepsi umum
        $errorMessage = $e->getMessage();

        // Kembalikan ke halaman sebelumnya dengan pesan error umum
        return back()->withErrors('Gagal menyimpan Artikel. Error: ' . $errorMessage);
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
