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
    // Method untuk update data rekam medis
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_rekammedis' => 'required',
            'id_poli' => 'required',
            'nik' => 'required',
            'tanggal_periksa' => 'required',
            'riwayat_penyakit' => 'required',
            'tekanan_darah' => 'required',
            'berat_badan' => 'required',
            'tinggi_badan' => 'required',
        ]);

        try {
            // Update data rekam medis berdasarkan ID
            RekamMedis::where('id_rekammedis', $request->id_rekammedis)->update([
                'id_poli' => $request->id_poli,
                'nik' => $request->nik,
                'tanggal_periksa' => $request->tanggal_periksa,
                'riwayat_penyakit' => $request->riwayat_penyakit,
                'tekanan_darah' => $request->tekanan_darah,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
            ]);

            // Redirect ke halaman atau tampilkan pesan sukses
            return redirect()->back()->with('success', 'Data rekam medis berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani error validasi
            return redirect()->back()->withErrors($e->errors())->withInput();
        } 
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

            // Memeriksa apakah ID Poli dan NIK sudah ada sebelumnya
            $id_poli = $validatedData['id_poli'];
            $nik = $validatedData['nik'];
            $id = $validatedData['id_rekammedis'];

            $poliExist = DB::table('poli_puskesmas')->where('id_poli', $id_poli)->exists();
            $masyarakatExist = DB::table('masyarakat')->where('nik', $nik)->exists();
            $idExist = DB::table('rekam_medis')->where('id_rekammedis', $id)->exists();

            if (!$poliExist || !$masyarakatExist || $idExist) {
                // Jika ID Poli atau NIK tidak ada dalam basis data, atau ID Rekam Medis sudah ada, kembalikan pesan error
                $errorMessage = [];
                if (!$poliExist) {
                    $errorMessage[] = 'ID Poli tidak valid.';
                }
                if (!$masyarakatExist) {
                    $errorMessage[] = 'NIK tidak valid.';
                }
                if ($idExist) {
                    $errorMessage[] = 'ID Rekam Medis sudah ada.';
                }
                Session::flash('error', implode(' ', $errorMessage));
                return redirect()->back();
            } else {
                // Jika NIK sama dengan NIK yang sudah ada, buat catatan baru
                $rekamMedis = rekammedis::create($validatedData);
                Session::flash('success', 'Data Rekam Medis berhasil disimpan!');
                return redirect()->back();
            }
        } catch (QueryException $e) {
            // Tangkap eksepsi query exception dan ambil pesan kesalahannya
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
