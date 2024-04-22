<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\table;

class artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel'; // Mengubah nama tabel sesuai dengan nama tabel yang sesuai di database Anda

    protected $fillable = [
        'id_artikel',
        'judul',
        'tanggal_publikasi',
        'img_artikel',
        'isi_artikel',
        'nip'
    ];

    // Jika diperlukan, Anda dapat menambahkan relasi atau metode lain di sini

    public static function getartikel()
    {
        return self::all();
    }

    public static function getData()
    {
        return self::all();
    }
}
