<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use function Laravel\Prompts\table;

class artikel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id_artikel';

    protected $fillable = [
        'id_artikel',
        'judul',
        'tanggal_publikasi',
        'img_artikel',
        'isi_artikel',
        'nip',
        'created_at',
        'updated_at'
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
