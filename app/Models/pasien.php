<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pasien extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'NIK',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin', // Diperbaiki typo di sini
        'no_bpjs',
        'email',
    ];

    public static function getAllPatients()
    {
        return self::all();
    }
}
