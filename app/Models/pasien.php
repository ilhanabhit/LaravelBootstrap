<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\table;

class pasien extends Model
{
    use HasFactory;

    protected $table = 'masyarakat';

    protected $fillable = [
        'nik',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin', // Diperbaiki typo di sini
        'no_bpjs'
    ];

    public static function getAllPasien()
    {
        return self::all();
    }

    public static function getdata(){
        return self::all();
    }
}
