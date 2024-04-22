<?php

namespace App\Http\Controllers;

use App\Models\rekammedis;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RekamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data rekam medis dari database
        $dataRekamMedis = rekammedis::all();
        // Tampilkan data rekam medis ke view data-rekam-medis.data-rekam-medis
        return view('data-rekam-medis.data-rekam-medis', compact('dataRekamMedis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat data rekam medis baru
        return view('data-rekam-medis.buat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'id_rekammedis' => 'required|string|max:255',
            'id_poli' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'tanggal_periksa' => 'required|date',
            'riwayat_penyakit' => 'required|string',
            'tekanan darah' => 'required|numeric|max:255',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
        ]);

        // Simpan data ke dalam database
        rekammedis::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('rekam.index')->with('success', 'Data rekam medis berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil data rekam medis berdasarkan ID
        $rekamMedis = rekammedis::findOrFail($id);
        // Tampilkan detail data rekam medis
        return view('data-rekam-medis.detail', compact('rekamMedis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data rekam medis berdasarkan ID
        $rekamMedis = rekammedis::findOrFail($id);
        // Tampilkan form untuk mengedit data rekam medis
        return view('data-rekam-medis.edit', compact('rekammedis'));
    }

    public function insert(Request $request)
    {
        try {
            // Validasi input sesuai kebutuhan
            $validatedData = $request->validate([
                'id_rekammedis' => 'required|string|max:255',
                'id_poli' => 'required|string|max:255|exists:poli_puskesmas,id_poli', // Validasi ID Poli di tabel poli_puskesmas
                'nik' => 'required|string|max:255|exists:masyarakat,nik', // Validasi NIK di tabel masyarakat
                'tanggal_periksa' => 'required|date',
                'riwayat_penyakit' => 'required|string',
                'tekanan_darah' => 'required|max:255',
                'berat_badan' => 'required|numeric',
                'tinggi_badan' => 'required|numeric',
            ]);
            // dd($validatedData);

            // Memeriksa apakah ID Poli dan NIK sudah ada sebelumnya
            $id_poli = $validatedData['id_poli'];
            $nik = $validatedData['nik'];
            $id = $validatedData['id_rekammedis'];

            $poliExist = DB::table('poli_puskesmas')->where('id_poli', $id_poli)->exists();
            $masyarakatExist = DB::table('masyarakat')->where('nik', $nik)->exists();
            $idExist = DB::table('rekam_medis')->where('id_rekammedis', $id)->exists();
            if (!$poliExist || !$masyarakatExist || !$idExist) {
                // Jika ID Poli atau NIK tidak ada dalam basis data, kembalikan pesan error
                $errorMessage = [];
                if (!$poliExist) {
                    $errorMessage[] = 'ID Poli tidak boleh berbeda.';
                }
                if (!$masyarakatExist) {
                    $errorMessage[] = 'NIK tidak boleh berbeda.';
                }
                if (!$idExist) {
                    $errorMessage[] = 'ID tidak boleh sama.';
                }
                Session::flash('error', implode(' ', $errorMessage));
                return redirect()->back();
            } else {
                // Jika ID Poli dan NIK ada, buat catatan baru
                $rekammedis = rekammedis::create($validatedData);
                Session::flash('success', 'Data Rekam Medis berhasil disimpan!');
                return redirect()->back();
            }

            // Redirect ke halaman index dengan notifikasi success
            return redirect()->route('rekam_medis');
        } catch (QueryException $e) {
            // Tangkap eksepsi query exception dan ambil pesan kesalahannya
            $sqlErrorMessage = $e->getMessage();

            // Kembalikan ke halaman sebelumnya dengan pesan error SQL
            return back()->withErrors('Gagal menyimpan Rekam Medis. Error SQL: ' . $sqlErrorMessage);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $id_rekammedis = $request->input('id_rekammedis');

            // Hapus data rekam medis dari database
            rekammedis::where('id_rekammedis', $id_rekammedis)->delete();

            Session::flash('success', 'Data rekam medis berhasil dihapus!');

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('rekam-medis');
        } catch (QueryException $e) {
            // Tangkap eksepsi query exception dan ambil pesan kesalahannya
            $sqlErrorMessage = $e->getMessage();

            // Kembalikan ke halaman sebelumnya dengan pesan error SQL
            return back()->withErrors('Gagal menghapus data rekam medis. Error SQL: ' . $sqlErrorMessage);
        }
    }
}
