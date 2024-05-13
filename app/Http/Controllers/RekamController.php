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
    try {
        // Validasi input
        $request->validate([
            'id_rekammedis' => 'required',
            'id_poli' => 'required|exists:poli_puskesmas,id_poli', // Memastikan id_poli yang dimasukkan ada dalam tabel poli_puskesmas
            'nik' => 'required',
            'tanggal_periksa' => 'required|date',
            'riwayat_penyakit' => 'required|string',
            'tekanan_darah' => 'required|string',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
        ], [
            'id_poli.exists' => 'ID Poli yang dipilih tidak valid.', // Pesan kustom untuk validasi id_poli yang tidak valid
        ]);

        // Ambil data rekam medis berdasarkan ID
        $rekamMedis = RekamMedis::findOrFail($request->id_rekammedis);

        // Update data rekam medis
        $rekamMedis->id_poli = $request->id_poli;
        $rekamMedis->nik = $request->nik;
        $rekamMedis->tanggal_periksa = $request->tanggal_periksa;
        $rekamMedis->riwayat_penyakit = $request->riwayat_penyakit;
        $rekamMedis->tekanan_darah = $request->tekanan_darah;
        $rekamMedis->berat_badan = $request->berat_badan;
        $rekamMedis->tinggi_badan = $request->tinggi_badan;

        // Simpan perubahan
        $rekamMedis->save();

        // Redirect ke halaman atau tampilkan pesan sukses
        return redirect()->back()->with('success', 'Data rekam medis berhasil diperbarui');
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Rekam medis tidak ditemukan.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()->withErrors($e->validator);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal memperbarui data rekam medis. Silakan coba lagi.');
    }
}




    public function insert(Request $request)
{
    try {
        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'id_rekammedis' => 'required|string|size:6', // Memastikan ID Rekam Medis tepat 6 karakter
            'id_poli' => 'required|string|max:255|exists:poli_puskesmas,id_poli',
            'nik' => 'required|string|max:255|exists:masyarakat,nik',
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
            
            $errorMessages = implode(' ', $errorMessage);
            
            // Buat notifikasi dalam bahasa Indonesia
            if (!$poliExist && !$masyarakatExist) {
                Session::flash('error', 'ID Poli dan NIK tidak valid.');
            } elseif (!$poliExist) {
                Session::flash('error', 'ID Poli tidak valid.');
            } elseif (!$masyarakatExist) {
                Session::flash('error', 'NIK tidak valid.');
            } elseif ($idExist) {
                Session::flash('error', 'ID Rekam Medis sudah ada.');
            }
            
            return redirect()->back();
        
        
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
