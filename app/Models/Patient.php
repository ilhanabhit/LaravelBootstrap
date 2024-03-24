<?php

namespace App\Models;

$patients = Patient::all();

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $tsble = '';

    protected $fillable = [
        'NIK',
        'nama',
        'tanggal_lahir',
        'jenis_kelasmin',
        'no_bpjs',
        'email',
    ];
}

