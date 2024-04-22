<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekammedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis'; // Ubah nama tabel sesuai dengan nama tabel yang sesuai di database Anda

    protected $fillable = [
        'id_rekammedis',
        'id_poli',
        'nik',
        'tanggal_periksa',
        'riwayat_penyakit',
        'tekanan_darah',
        'berat_badan',
        'tinggi_badan'
    ];

    // Jika diperlukan, Anda dapat menambahkan relasi atau metode lain di sini

    public static function getrekammedis()
    {
        return self::all();
    }

    public static function getData()
    {
        return self::all();
    }
}
